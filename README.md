# WordPressテーマ制作用

dockerを使ったWordPress用のボイラープレートです。

## 使う前に

以下のプロキシーサーバーを事前に導入すること  
※ 以下は、nginx-proxyとmailhogを導入したdocker用データです。  
※ 自前で用意されている場合は、そちらをご利用ください。  
https://github.com/nullpon16tera/docker-proxy-server

※−−−−−−−−−−−−−−−−−−−−−※  
80番ポートが別のアプリケーションで利用されていると起動することができません。  
スタートアップ起動の設定がされているアプリケーションで80番ポートを利用している場合は、スタートアップから削除してください。80番ポートで接続ができなくなります。  
削除や停止を行なったけど、80番ポートで接続できない場合は、作業時のみセキュリティーレベルを変更してください。  
※−−−−−−−−−−−−−−−−−−−−−※

### .envファイルについて

.envファイルがあるので、エディターで開きドメインの書き換えをしてください。

VIRTUAL_NAMEの部分を書き換え  
cc5.meはループバックドメインに設定しているので、hostsの編集無しでそのままご利用いただけます。  
例）`example.co.jp.cc5.me`など、実ドメインとcc5.meを組み合わせていただくことも可能です。

```bash
VIRTUAL_NAME=example.cc5.me
WP_ENV=development
```

`WP_ENV`は、PHPの環境変数で利用するために作成しています。  
環境変数は追加しても構いません。


## Commands

```bash
# docker container Install & Run
$ make run

# docker container Shutdown
$ make down

# docker container Restart
$ make restart

# make watchやbuildをする前に、npm installが必要です。
$ npm install

# gulp watch。ScssやJavaScriptの監視とコンパイルとBrowserSyncを立ち上げます。
# 同時に画像の圧縮も行います。
$ make watch

# gulp build。上記のやつを本番用のファイルにビルドする
$ make build
```

- phpMyAdmin [http://phpmyadmin.example.cc5.me](http://phpmyadmin.example.cc5.me)
- WordPress [http://example.cc5.me](http://example.cc5.me)

MailHogが利用できる場合は、  
`http://example.cc5.me:8025`などでWebビューにアクセスできます。ドメインは各自用意したものに書き換えてください。

## ファイル

- `/resource/` テーマデータ
- `/src/img/` 画像の元データをここに入れます。
- `/src/js/` JavaScriptファイル（webpack & babel を利用してます）
- `/src/scss/` Scssファイル