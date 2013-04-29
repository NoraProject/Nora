<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace NoraTest\Nora;

use Nora;
use NoraTest;

class MainTestCase extends NoraTest\TestCase
{
    public function testMain( )
    {
        // BundleHelperを呼び出す
        $arrayHelper = nora()->array(array('a'=>'b'));
        $this->assertInstanceOf(
            'Nora\Bundle\Helper\ArrayHelper',
            $arrayHelper
        );

        // BundleComponentを呼び出す
        $logComponent = nora()->log;
        $this->assertInstanceOf(
            'Nora\Bundle\Component\LogComponent',
            $logComponent
        );

        // 結局はグローバルコンテナを操作してるだけ
        $logComponent = Nora\DI\Container::getInstance( )->pull('component.log');
        $this->assertInstanceOf(
            'Nora\Bundle\Component\LogComponent',
            $logComponent
        );
    }
}
