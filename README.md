# medical-documents-api

git clone https://github.com/zr-msv/medical-documents-api.git

cd medical-documents-api

cp .env.example .env


docker-compose build app

docker-compose up -d


//make sure docker is runnig:
docker ps

---
docker exec -it medical-app-container bash
composer install
php artisan key:generate
php artisan migrate
php artisan storage:link

-------
