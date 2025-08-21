<!-- PROJECT LOGO -->
<br />
<div align="center">
  <img src="https://github.com/ishaqadhel/docker-laravel-mysql-nginx-starter/assets/49280352/cb88bac9-2517-41fe-805e-b81423e64eca" alt="cover" align="center">
  <h3 align="center">Test task Docker Laravel MySQL Nginx Starter</h3>

</div>

<!-- GETTING STARTED -->
## Getting Started
- `https://github.com/ishaqadhel/docker-laravel-mysql-nginx-starter` : link on the docker
- `make run-app-with-setup-db` : build docker and start all docker containers with Laravel setup + database migration and seeder
- edit .env
  - TELEGRAM_BOT_TOKEN=12321312312312
    TELEGRAM_BOT_WEBHOOK_URL=https://123123123123.ngrok-free.app/api/telegram/webhook
- install and run **ngrok** on port 8001
- change telegram id
- `docker exec -it php ./vendor/bin/phpunit
  ` : for unit tests
