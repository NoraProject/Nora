<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora\Module\Bundle\Helper;

use Nora\Helper;

/**
 * モジュール環境ヘルパ
 */
class ENVHelper extends \ArrayObject implements Helper\HelperIF
{
    use Helper\HelperTrait;


    public function EnvHelper( $key = false, $value = false )
    {
        if( $key == false ){
            return $this;
        }

        if( $value == false ){
            return $this[$key];
        }

        $this[$key] = $value;

        return $this;
    }

    public function export( )
    {
        var_export($this);
    }
}
