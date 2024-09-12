## ローカルでの確認

php artisan serve

## aws e2c での確認

SSH接続

ホームディレクトリに移動
```
ssh -i  ~/.ssh/xxx.pem ec2-user@X.X.X.X
```

$ sudo systemctl start nginx
$ sudo systemctl enable nginx

ステータスを確認
$ sudo systemctl status nginx

 /var/www/twitter-clone
 
httpでアクセスする

デプロイ
```
git pull
composer install
php artisan migrate
php artisan serve
```

## データベースの設定
