<?php
/**
 * のらプロジェクトファイル
 *
 * @author     ハジメ <mail@hazime.org>
 * @copyright  opyright (c) 2013, nora project all rights reserved.
 * @license    http://www.hazime.org/license/licence.txt
 * @version    $id$
 */
namespace Nora\Loader;

/**
 * クラスを自動読み込みさせる
 */
interface ClassLoaderIF
{
    /**
     * スタティックにローダを取得する
     */
    static public function getLoader( );

    /**
     * ローダを登録する
     */
    public function register( );

    /**
     * ローダを解除する
     */
    public function unregister( );

    /**
     * プレフィックスを追加する
     *
     * @param string クラス名のプレフィックス
     * @param mixed ディレクトリ名かその配列
     */
    public function addPrefix( $prefix, $dir = false);

    /**
     * クラス定義ファイルを探す
     */
    public function findClassFile( $class_name );

    /**
     * ローダを実行する
     */
    public function loadClass( $class_name );
}
