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

/**
 * FactoryIF
 */
interface FactoryIF
{
    public function create( $key );
    public function setDIContainer( $Container );
}
