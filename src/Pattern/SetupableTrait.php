<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora\Pattern;

/**
 * SetupableTrait
 */
trait SetupableTrait
    {
        public function setup($name, $value = false)
        {
            if( $value == false && is_array($name) ){
                foreach( $name as $k=>$v) $this->setup($k,$v);
                return $this;
            }

            if(method_exists($this,$real_name = "setup".$name)){
                call_user_method(array($this,$real_name), $value);
                return $this;
            }

            if(property_exists($this,$real_name = "setup_".$name)){
                $this->$real_name = $value;
                return $this;
            }

            throw new \Exception("$name をセットアップできません");
        }
    }
