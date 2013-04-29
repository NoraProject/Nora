<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora\DI\Factory;

use Nora\Helper;
/**
 * FactoryIF
 */
class ClassName implements FactoryIF
{
    private $_class_name;

    public function __construct( $class_name )
    {
        $this->_class_name = $class_name;
    }

    public function setDIContainer( $container )
    {
        $this->_container = $container;
    }

    public function create( $key )
    {
        $rc = new \ReflectionClass($this->_class_name);
        $object = $rc->newInstance();
        if( $object instanceof Helper\HelperIF ){
            $object->setOwner( $this->_container->getOwner( ));
            $object->setup( $this->_container->getRegistry($key,'params'));
        }
        return $object;
    }
}
