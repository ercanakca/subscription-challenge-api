### Kurulum Aşamaları

1. Composer ile gerekli paketleri yükleyin.
```
composer update && cd third_party_api && composer update && cd ..
```

2. Aşağıdaki komut ile docker build alıp sistemi ayağa kaldırın.
```
docker-compose up -d
```
3. `app` container içine girin.
```
docker-compose exec app bash
```

4. Migrate ve Seed komutlarını çalıştırın
```
php artisan migrate && php artisan db:seed
```

