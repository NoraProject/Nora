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
class FileHelper implements Helper\HelperIF
{
    use Helper\HelperTrait;

    private $_file = false;

    public function bindFile( &$file )
    {
        $this->_file =& $file;
    }

    public function FileHelper( $file = false )
    {
        if( $file == false ){
            return $this;
        }

        $object = clone $this;
        $object->bindFile($file);
        return $object;
    }
}
