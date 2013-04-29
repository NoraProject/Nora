<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace NoraTest\DI\Container;

use Nora;
use NoraTest;

class MainTestCase extends NoraTest\TestCase
{
    public function testMain( )
    {
        $container = new Nora\DI\Container();
        $container->putFactory('test.array', function( $DIContainer ) {
            return new \ArrayObject();
        });

        $factory = $container->pullFactory('test.array');
        $this->assertInstanceOf('\Closure',$factory);

        $object = $container->pull('test.array');
        $object['a'] = 'b';

        // 二度目の実行では新しいオブジェクトは作られない
        $object = $container->pull('test.array');
        $this->assertEquals($object['a'],'b');
    }

    public function testLoadFactoryDirectory( )
    {
        $container = new Nora\DI\Container();
        $container->load(
            'helper',
            NORA_SRC.'/Bundle/Helper',
            'Nora\Bundle\Helper',
            'Helper'
        );

        // ArrayHelper
        $this->assertInstanceOf(
            'Nora\Bundle\Helper\ArrayHelper',
            $container->pull('helper.array')
        );
    }
}
