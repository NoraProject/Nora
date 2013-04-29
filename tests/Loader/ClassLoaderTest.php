<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace NoraTest\Loader\ClassLoader;

use Nora;
use NoraTest;

class MainTestCase extends NoraTest\TestCase
{
    public function testMain( )
    {
        $this->assertInstanceOf(
            'Nora\Loader\ClassLoader',
            Nora\Loader\ClassLoader::getLoader()
        );
    }
}
