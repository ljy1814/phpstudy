<?php
/*
 * Author : slack 
 * Email : yajin160305@gmail.com
 * File : Template.php
 * CreateDate : 2016-11-27 02:14:17
 * */

class Template {
    private $arrayConfig = array(
        'suffix' => '.m',   //后缀
        'templateDir' => 'template/',  //模板所在文件夹
        'compiledir' => 'cache/',   //编译后存放目录
        'cache_htm' => false,   //是否需要编译成静态的html
        'suffix_cache' => '.htm',   //编译文件的后缀
        'cache_time' => 2000,       //多长时间自动更新
        'php_turn' => true,         //是否支持原生的PHP代码
        'cache_control' => 'control_dat',
        'debug' => false
    );
    public $file;   //模板文件名,不带后缀
    private $value = array();   //值栈
    private $compileTool;   //编译器
    static private $instance = null;
    private $debug = array();   //调试信息
    private $controlData = array();

    public function __construct($arrayConfig = array())
    {
        $this->debug['begin'] = microtime(true);
        $this->arrayConfig = $arrayConfig + $this->arrayConfig;
        $this->getPath();
        if(!is_dir($this->arrayConfig['templateDir'])) {
            exit("template dir is not found");
        }
        if(!is_dir($this->arrayConfig['compiledir'])) {
            mkdir($this->arrayConfig['compiledir'], 0770, true);
        }
        include ('CompileClass.php');
    }
    /**
     * 路径处理为绝对路径
     */
    public function getPath()
    {
        $this->arrayConfig['templateDir'] = strtr(realpath($this->arrayConfig['templateDir']), '\\', '/'). '/';
        $this->arrayConfig['compiledir'] = strtr(realpath($this->arrayConfig['compiledir']), '\\', '/'). '/';
    }

    /**
     * 
     * 
     **/
    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new Template();
        }
        return self::$instance;
    }
    /**
     * 设置模板引擎参数
     * */
    public function setConfig($key, $value = null)
    {
        //key是数组,也就是传入的是键值对
        if(is_null($key)) {
            $this->arrayConfig = $key + $this->arrayConfig;
        } else {
            $this->arrayConfig[$key] = $value;
        }
    }

    /**
     * 
     * 获取配置
     * */
    public function getConfig($key = null)
    {
        if($key) {
            return $this->arrayConfig[$key]; 
        } else {
            return $this->arrayConfig;
        }
    }

    /**
     * 注入单个变量
     * 
     * */
    public function assign($key, $value)
    {
        $this->value[$key] = $value; 
    }

    /**
     * 注入数组
     * */
    public function assignArray($array)
    {
        if(is_array($array)) {
            foreach($array as $key => $value) {
                $this->value[$key] = $value;
            }
        }
    }

    /**
     * 
     * */
    public function path()
    {
        if($this->file) {
            $this->file = ucfirst($this->file);
        }
        return $this->arrayConfig['templateDir'] . $this->file . $this->arrayConfig['suffix'];
    }

    /**
     * 判断是否开启了缓存
     * */
    public function needCache()
    {
        return $this->arrayConfig['cache_htm'];
    }

    /**
     * 是否需要生成静态文件
     * */
    public function reCache($file)
    {
        $flag = false;
        $cacheFile = $this->arrayConfig['compiledir'] . md5($file) . 'htm';
        if($this->arrayConfig['cache_htm'] === true) {
            $timeFlag = (time() - @filemtime($cacheFile)) < $this->arrayConfig['cache_time'] ? true : false;
            $flag = is_file($cacheFile) && filesize($cacheFile) > 1 && timeFlag ? true : false; 
        }
        return $flag;
    }

    /**
     * 显示模板
     * */
    public function show($file)
    {
        $this->file = $file;
        $tem = $this->path();
        if(!is_file($tem)) {
            exit("找不到对应的模板");
        }
        $compileFile = $this->arrayConfig['compiledir'] . md5($file) . '.php';
        $cacheFile = $this->arrayConfig['compiledir'] . md5($file) . '.htm';
        if($this->reCache($file) === false) {
            $this->debug['cached'] = 'false';
            $this->compileTool = new CompileClass($this->path(), $compileFile, $this->arrayConfig);
            if($this->needCache()) {
                ob_start();
            }
            extract($this->value, EXTR_OVERWRITE);
            if(!is_file($compileFile) || filemtime($compileFile) < filemtime($this->path())) {
                $this->compileTool->vars = $this->value;
                $this->compileTool->compile();
                include $compileFile;
            } else {
                include $compileFile;
            }
            if($this->needCache()) {
                $message = ob_get_contents();
                file_put_contents($cacheFile, $message);
            }
        } else {
            readfile($cacheFile);
            $this->debug['cached'] = 'true';
        }
        $this->debug['spend'] = microtime(true) - $this->debug['begin'];
        $this->debug['count'] = count($this->value);
        $this->debug_info();
    }

    /**
     * 输出debug信息
     * */
    public function debug_info() {
        if($this->arrayConfig['debug'] === true) {
            echo PHP_EOL, '---------debug info---------', PHP_EOL;
            echo '程序运行日期:', date('Y-m-d h:i:s'), PHP_EOL;
            echo '模板解析耗时:', $this->debug['spend'], '秒', PHP_EOL;
            echo '模板包含标签数目:', $this->debug['count'], PHP_EOL;
            echo '是否使用静态缓存:', $this->debug['cached'], PHP_EOL;
            echo '模板引擎实例参数:', var_dump($this->getConfig());
        }
    }

    /**
     * 清理缓存的HTML文件
     * */
    public function clean($path = null)
    {
        if($path === null) {
            $path = $this->arrayConfig['compiledir'];
            $path = glob($path, '*' . $this->arrayConfig['suffix_cache']);
        } else {
            $path = $this->arrayConfig['compiledir'] . md5($path) . '.htm';
        }
        foreach((array)$path as $v) {
            unlink($v);
        }
    }
}
/* vim: set tabstop=4 set shiftwidth=4 */

