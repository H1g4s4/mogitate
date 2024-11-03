# アプリケーション名
Mogitate

## 環境構築
1.このリポジトリのurlを取得してクローン
$ git clone git@github.com:H1g4s4/mogitate.git
$ mv laravel-docker-template mogitate

2.ご自身で作成したリポジトリからurlを取得し、以下のコマンドを実行
$ git remote set-url origin 作成したリポジトリのURL
$ git remote -v

3.現在のローカルリポジトリをリモートリポジトリに反映させる
$ git add .
$ git commit -m "リモートリポジトリの変更"
$ git push origin main

4.Dockerの設定
$ docker-compose up -d --build
$ code .

5.Laravelのパッケージをインストール
PHPコンテナにログイン
$ docker-compose exec php bash

ログインできたら以下のコマンドでインストール
$ composer install

6. .envファイルの作成
$ cp .env.example .env
$ exit

## 使用技術
Laravel: 8.83.8
PHP: 7.4.9
Docker: 27.0.3

##ER図
/Users/higasa/coachtech/mogitate/src/public/images/ER図.png

##URL
開発環境:http://localhost
