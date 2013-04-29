<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora\Module;

use Nora\Component;
use Nora\DI;

/**
 * モジュール
 */
class Module implements Component\ComponentIF,DI\ContainerOwnerIF
{
    use Component\ComponentTrait;
    use DI\ContainerOwnerTrait;

    public function initComponent( $Container = false )
    {
        if( $Container == false ) $Container = DI\Container::getInstance();

        // 親付きでコンテナをビルドする
        $this->setContainer( new DI\Container( $this, $Container ) );

        // Bundle Helper
        $this->getContainer( )->load(
            'helper',
            NORA_SRC.'/Module/Bundle/Helper',
            'Nora\Module\Bundle\Helper',
            'Helper'
        );

        // BundleComponent 
        $this->getContainer( )->load(
            'component',
            NORA_SRC.'/Module/Bundle/Component',
            'Nora\Module\Bundle\Component',
            'Component'
        );
    }

    public function __call($name, $args)
    {
        return $this->getHelper($name)->invokeArgs($args);
    }

    public function __get($name)
    {
        return $this->getComponent($name);
    }
}
