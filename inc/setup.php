<?php

function my_team_setup() {
    // ブロックの標準スタイルを有効化（これがないとボタンなどが素っ気なくなります）
    add_theme_support('wp-block-styles');
    
    // エディターに独自のスタイルを当てるための宣言
    add_theme_support('editor-styles');
    
    // 実際に読み込むエディター用CSSのパスを指定（assets/css/main.cssがある場合）
    add_editor_style('assets/css/main.css');

    // 埋め込みコンテンツ（YouTubeなど）をレスポンシブにする
    add_theme_support('responsive-embeds');

    // 【重要】アイキャッチ画像を有効にする（投稿一覧で画像を出すなら必須）
    add_theme_support('post-thumbnails');

    // 【重要】タイトルタグを自動生成（<head>内に自力で書かなくて良くなります）
    add_theme_support('title-tag');

    // 以前のHTML5形式での出力をサポート
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
}

add_action('after_setup_theme', 'my_team_setup');