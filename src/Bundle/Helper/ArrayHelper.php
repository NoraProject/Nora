<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora\Bundle\Helper;

use Nora\Helper;

/**
 * 配列操作ヘルパ
 */
class ArrayHelper implements Helper\HelperIF
{
    use Helper\HelperTrait;

    private $_array = false;

    public function bindArray( &$array )
    {
        $this->_array =& $array;
    }

    public function ArrayHelper( $array = false )
    {
        if( $array == false ){
            return $this;
        }

        $object = clone $this;
        $object->bindArray($array);
        return $object;
    }
}
