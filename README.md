# 勤怠管理システム
## 環境構築
Dockerビルド  
1.git clone git@github.com:coachtech-material/laravel-docker-template.git  
2.docker-compose up -d --build  

Lavaral環境構築  
1.docker-compose exec php bash  
2.composer install  
3.cp .env.example .env  
4..envファイルの変更  
 (1)DB_HOSTをmysqlに変更  
 (2)DB_DATABASEをlaravel_dbに変更  
 (3)DB_USERNAMEをlaravel_userに変更  
 (4)DB_PASSをlaravel_passに変更  
 (5)MAIL_FROM_ADDRESSに送信元アドレスを設定  
5.php artisan key:generate  
6.php artisan migrate  
7.php artisan db:seed  
8.php artisan test   


## 使用技術
・PHP 7.4.9  
・Laravel 8.83.8  
・MySQL 8.0.26  
・nginx 1.21.1  
・MailHog latest  

## ER図
![er](https://github.com/user-attachments/assets/323ed7be-88a0-474d-8af5-6ee5764329e4)


  

### URL
・開発環境：http://localhost/  
・phpMyAdmin：http://localhost:8080/  
・MailHog：http://localhost:8025/
