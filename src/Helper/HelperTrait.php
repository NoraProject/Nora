<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora\Helper;

use Nora\Pattern;

/**
 * ヘルパTrait
 */
trait HelperTrait
    {
        use Pattern\SetupableTrait;

        private $_owner;

        public function invokeArgs( $args )
        {
            $class = get_class($this);
            $name = substr( $class, strrpos($class,'\\') + 1);
            return call_user_func_array(array($this,$name), $args);
        }

        public function setOwner( $owner )
        {
            $this->_owner = $owner;
        }

        public function getOwner( )
        {
            return $this->_owner;
        }
    }
