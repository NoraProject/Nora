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
 * ディレクトリヘルパ
 */
class FilerHelper implements Helper\HelperIF
{
    use Helper\HelperTrait;

    protected $setup_rootdir = '/';

    public function FilerHelper( $dir = false )
    {
        if( $dir == false ){
            return $this;
        }

        $object = clone $this;
        $object->setup('rootdir',$dir);
        return $object;
    }
}
