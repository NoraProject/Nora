<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace NoraTest\Module\Module;

use Nora;
use NoraTest;

class MainTestCase extends NoraTest\TestCase
{
    public function setup( )
    {
        nora(); // Noraを初期化
    }
    public function testMain( )
    {
        $module = new Nora\Module\Module( );
        $module->initComponent();
        $list = $module->getContainer( )->getList();
        $this->assertInstanceOf(
            'Nora\Module\Bundle\Helper\ENVHelper',
            $module->getHelper('env')
        );
    }

    public function testENVHelper( )
    {
        $module = new Nora\Module\Module( );
        $module->initComponent();
        $module->env('env','development');
        $module->env('path',NORA_SRC);
        $this->assertEquals($module->env('path'), NORA_SRC);
    }

    public function testPaththrogh( )
    {
        $module = new Nora\Module\Module( );
        $module->initComponent();
        $this->assertInstanceOf(
            'Nora\Bundle\Helper\ArrayHelper',
            $module->array(array('a'=>'b'))
        );
    }

    public function testLocalize( )
    {
        $module = new Nora\Module\Module( );
        $module->initComponent();
        $array = $module->array(array('a'=>'b'));
        $this->assertNull($array->getOwner());

        // ローカライズすればオーナーはモジュールになる
        $module->getContainer( )->localize(
            array('helper.array')
        );
        $array = $module->array(array('b'=>'c'));
        $this->assertNotNull($array->getOwner());
    }
    public function testLocalizeWithParam( )
    {
        $module = new Nora\Module\Module( );
        $module->initComponent();
        $module->getContainer( )->localize(
            array(
                'helper.array',
                'helper.filer'=>array('rootdir'=>NORA_SRC.'/doc')
            )
        );
        $file = $module->filer();
        var_dump($file);
    }
}
