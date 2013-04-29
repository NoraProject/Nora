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

/**
 * DIコンテナオーナー
 */
trait ContainerOwnerTrait
    {
        private $_di_container = false;

        public function setContainer( $container )
        {
            $this->_di_container = $container;
        }

        public function getContainer( )
        {
            if( $this->_di_container ) return $this->_di_container;

            return Container::getInstance();
        }

        public function getHelper($name)
        {
            return $this->getContainer( )->pull('helper.'.$name);
        }

        public function getComponent($name)
        {
            return $this->getContainer( )->pull('component.'.$name);
        }
    }
