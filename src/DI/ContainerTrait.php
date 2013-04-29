<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora\DI;

use Nora\Pattern;

/**
 * DIコンテナ機能
 */
trait ContainerTrait
    {
        use Pattern\SingletonTrait;

        private $_parent_container;
        private $_owner;
        private $_registry = array();

        public function __construct( $Owner = false, $Container = false )
        {
            if( $Owner ) {
                $this->_owner = $Owner;
            }
            if( $Container ) {
                $this->_parent_container = $Container;
            }
        }

        public function localize( $array )
        {
            foreach( $array as $k=>$v )
            {
                if( is_int($k) ){
                    $k = $v;
                    $v = array();
                }

                if( $this->_parent_container) {
                    $this->delRegistry($k);
                    $this->putFactory(
                        $k,
                        $this->_parent_container->pullFactory($k),
                        $v
                    );
                }
            }

        }

        /**
         * コンテナオーナーを取得する
         */
        public function getOwner( )
        {
            return $this->_owner;
        }

        /**
         * ディレクトリを読み込む
         */
        public function load( 
            $namePrefix,
            $directory, 
            $prefix, 
            $suffix, 
            $factoryClass = 'Nora\DI\Factory\ClassName' 
        ){
            if( !is_dir($directory) ){
                return false;
            }
            $dir = dir($directory);
            while( $file = $dir->read() ){
                if($file{0} == '.') continue;
                $pos = strrpos( $file, $suffix.'.php' );
                if( $pos > 0 ){
                    $name = substr($file,0,$pos);
                    $classname = $prefix.'\\'.$name.$suffix;
                    $rc = new \ReflectionClass( $factoryClass );
                    $factory = $rc->newInstance($classname);
                    $this->putFactory( $namePrefix.".".$name, $factory);
                }
            }
        }

        /**
         * 依存をputする
         */
        public function put( $name, $factory, $params = array() )
        {
            $this->putFactory( $name, $factory, $params );
        }

        /**
         * 依存をpullする
         */
        public function pull( $name )
        {
            // 既に実体があれば実体を返却
            if( $this->hasRegistry($name, 'instance') ) {
                return $this->getRegistry($name, 'instance');
            }

            // ファクトリがあればクリエートする
            if( $this->hasRegistry($name, 'factory') ) {
                $object = $this->create( $name, $this->pullFactory( $name ) );
                $this->setRegistry($name,'instance',$object);
                return $object;
            }

            // 親がいれば親をpullする
            if( $this->_parent_container ){
                return $this->_parent_container->pull($name);
            }
        }

        /**
         * オブジェクトを作成する
         */
        public function create( $key, $factory )
        {
            if( $factory instanceof \Closure ) {
                return $factory( $this );
            }
            if( $factory instanceof Factory\FactoryIF ) {
                $factory->setDIContainer($this);
                return $factory->create( $key );
            }
        }

        /**
         * ファクトリをputする
         */
        public function putFactory( $name, $factory, $params = array() )
        {
            $this->setRegistry( $name, 'factory', $factory);
            $this->setRegistry( $name, 'params', $params);
        }

        /**
         * ファクトリをpullする
         */
        public function pullFactory( $name )
        {
            if( $this->hasRegistry($name, 'factory') ) {
                return $this->getRegistry( $name, 'factory');
            }

            // 親がいれば親をpullする
            if( $this->_parent_container ){
                return $this->_parent_container->pullFactory($name);
            }
        }

        /**
         * 登録されているオブジェクト一覧
         */
        public function getList( )
        {
            return array_keys($this->_registry);
        }

        /**
         * レジストリに登録
         */
        public function setRegistry( $input_name, $input_type, $object )
        {
            $name = strtolower($input_name);
            $type = strtolower($input_type);

            $this->_registry[$name][$type] = $object;
        }

        /**
         * レジストリから取得
         */
        public function getRegistry( $input_name, $input_type)
        {
            $name = strtolower($input_name);
            $type = strtolower($input_type);

            return $this->_registry[$name][$type];
        }

        /**
         * レジストリをチェックする
         */
        public function hasRegistry( $input_name, $input_type)
        {
            $name = strtolower($input_name);
            $type = strtolower($input_type);

            return isset($this->_registry[$name][$type]);
        }

        /**
         * レジストリを削除する
         */
        public function delRegistry( $input_name )
        {
            $name = strtolower($input_name);
            unset($this->_registry[$name]);
        }
    }
