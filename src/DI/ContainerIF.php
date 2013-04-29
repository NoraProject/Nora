<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora\DI;

/**
 * DIコンテナインターフェイス
 */
interface ContainerIF
{
    /**
     * 依存をputする
     */
    public function put( $name, $factory );

    /**
     * ファクトリをputする
     */
    public function putFactory( $name, $factory );

    /**
     * レジストリに登録
     */
    public function setRegistry( $input_name, $input_type, $object );

    /**
     * レジストリから取得
     */
    public function getRegistry( $input_name, $input_type);
}
