開発環境構築用にapacheの設定し、任意のポートをサイト用のルートディレクトリに設定する

設定をするのは次の2ファイル
Apache/conf/httpd.conf
Apache/conf/extra/httpd-vhosts.conf

今回は8085ポートを指定し、次のアドレスで表示されるようにする
http://localhost:8085/

※httpd.confの設定

#追加
Listen  8085

#rewrite モジュールを読み込む
#コメントをはずす
LoadModule rewrite_module modules/mod_rewrite.so

#rewrite モジュールを読み込む
#コメントをはずす
Include conf/extra/httpd-vhosts.conf

※httpd-vhosts.confの設定

#追加
NameVirtualHost *:8085

#追加
<VirtualHost *:8085>
    ServerAdmin webmaster@dummy-host.ummt.jp
    DocumentRoot "C:\Program Files\Zend\Apache2\htdocs\sample_system"
    ServerName local.sample_system
    ServerAlias www.local.sample_system
    ErrorLog "logs/dummy-host.sample_system-error.log"
    CustomLog "logs/dummy-host.sample_system-access.log" common
</VirtualHost>