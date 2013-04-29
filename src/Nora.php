<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora;

use Nora\Pattern;
use Nora\Helper;
use Nora\DI;

/**
 * Nora
 */
class Nora implements Pattern\SingletonIF,DI\ContainerOwnerIF
{
    use Pattern\SingletonTrait;
    use DI\ContainerOwnerTrait;

    private function __construct( )
    {
        $this->setContainer( DI\Container::getInstance() );

        // Bundle Helper
        $this->getContainer( )->load(
            'helper',
            NORA_SRC.'/Bundle/Helper',
            'Nora\Bundle\Helper',
            'Helper'
        );

        // BundleComponent 
        $this->getContainer( )->load(
            'component',
            NORA_SRC.'/Bundle/Component',
            'Nora\Bundle\Component',
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
