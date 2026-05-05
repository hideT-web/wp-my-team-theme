# My Team Theme  (Standard Block Theme)

標準仕様をベースに設計された、初期状態のWordPressブロックテーマです

## 📋 テーマのコンセプト
- Hybrid Development: エディタでの直感的なデザインを `Create Block Theme` プラグインで物理ファイルへ同期を行い、コード管理と両立
- Modern Architecture: `theme.json` v3 を採用。`link` や `link-hover` 等、役割ベース（Semantic）な色定義を標準化
- Clean & Fast: 不要なコアパターン、絵文字スクリプト、WPバージョン情報を徹底排除。軽量化とセキュリティを両立

---

## 🛠 開発環境・前提条件

### 1. 動作環境
- WordPress: v6.6以上 (theme.json v3 正式対応)
- PHP: 8.1以上 (filemtimeによるキャッシュバスティング使用)

### 2. おすすめプラグイン構成
- SEO SIMPLE PACK: メタタグ・OGP管理
- CloudSecure WP Security: セキュリティ対策
- Admin Menu Editor: クライアント用管理画面の最適化
- UpdraftPlus：自動バックアップ
- Create Block Theme (開発時のみ): エディタの変更を物理ファイルへ書き出す

---

## 🚀 制作・運用フロー

### ステップ1：初期セットアップ
1. 本フォルダを WP管理画面からインストール、有効化
　 ※`wp-content/themes/my-team-theme` に配置   

### ステップ2：デザイン・レイアウト構築
1. 管理画面「外観 > エディター」から編集実施
2. theme.json共通項目(カラー、フォントサイズなど)の設定
3. templates/に各ページを設定
4. 編集実施 

### ステップ3：テーマファイルの更新
1. デザイン完了後、`Create Block Theme` で 「Save Changes」 を実行
2. 変更された `theme.json` や `templates/*.html` の差分をエクスポート(バックアップ用)

注：この操作はDB上の変更をファイルへ書き出すものであり、DBリセットは行わない

---

## 📂 フォルダ構成の役割

```
my-team-theme/
├── theme.json                      # (必須)設計図。色・フォント・余白の共通ルール
├── style.css                       # (必須)テーマのメタ情報のみ
├── functions.php                   # 軽量化・セキュリティ・ショートコードの最小機能
├── README.md                       # ローカル環境の構築手順など記載(このファイル)
├── assets/                  		# 内部で設定するリソース
│   ├── css/                		# theme.json で完結しない高度な CSS (Sass など)
│   │    └─ main.css
│   ├── js/                 		# 独自のスクリプト (スライダー、アニメーション等)
│   │    └─ main.js
│   └── images/             		# テーマ内で共通して使うロゴ、アイコン、背景画像
├── inc/                            # テーマの機能分割
│   ├── enqueue.php                 # 外部ファイル（CSS/JS）の読み込み
│   └── setup.php                   # テーマの基本設定（初期起動設定）
│ 
├── templates/               		# ページの「枠組み」
│   ├── index.html          	    # (必須)全ページのベース
│   ├── front-page.html             # トップページ専用
│   ├── 個別投稿                     # (WPエディタで作成)投稿ページ
│   ├── 固定ページ                   # (WPエディタで作成)固定ページ
│   ├── 固定ページ(タイトルなし)      # (WPエディタで作成)固定ページ(タイトルなし)
│   ├── すべてのアーカイブ            # (WPエディタで作成)一覧ページ（カテゴリーやタグ）用
│   ├── 検索結果                     # (WPエディタで作成)検索結果一覧ページ用
│   └── ページ: 404            		 # (WPエディタで作成)ページが見つからない場合に表示
│ 
├── parts/                          # 【最重要】共通パーツとメニュー
│   ├── header.html                 # ヘッダー
│   ├── footer.html                 # フッター
│   └── sidebar.html                # サイドバー
│
└── screenshot.png                  # テーマイメージ画像(1200px × 900px)
```

---

## ⚙️ テーマの内部処理（functions.php）

本テーマでは、最小限の機能のみを実装し、軽量かつ安全な構成を採用しています

### 主な処理内容

- 不要なクエリパラメータ（`?ver=`）の削除  
  → CSS / JS のURLからバージョン情報を削除し、URLの簡素化

- WordPressコアの不要機能の無効化  
  - ブロックパターン削除  
  - 絵文字スクリプト削除  

- セキュリティ強化  
  - WordPressバージョン情報の非表示  

- ショートコード  
  - `[copyright]`：コピーライト表記を自動生成 

---

## 🛠 独自機能 (Shortcodes)

- `[copyright]`: 西暦(本年)、サイト名（リンク付）を自動表示するコピーライト署名

---

## 🎨 CSS設計ポリシー

- 基本スタイルは `theme.json` で管理
- `assets/css/main.css` は補助的な装飾のみ使用
- セレクタは構造依存を避け、シンプルに設計（例：`main h1`）

※配布テーマとしての互換性を優先し、  
　過度なクラス依存（`.wp-block-post-content` 等）は避けています

---

## 🧱 テンプレート構造

本テーマでは、CSSの安定適用とセマンティック構造を考慮し、  
メインコンテンツ領域を `<main>` タグでラップしています

※本テーマは `<main>` を基準にスタイル設計を行っています

サイドバーを使用する場合は、`<main>` の外側に配置する設計にしています

例：

```html
<header>...</header>

<div class="container">
  <main>コンテンツ</main>
  <aside>サイドバー</aside>
</div>

<footer>...</footer>
```
### メリット
- CSS適用が安定
- SEO・アクセシビリティ向上
- カスタマイズ時の崩れ防止

---

## 🤝 メンテナンス
- 作成: HideT
- 最終更新日: 2026年5月5日
