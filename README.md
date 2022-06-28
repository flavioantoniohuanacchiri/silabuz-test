
# Reto para Silabuz - Perú

Este repositorio implementa 3 APIs de Deezer de forma similar como en su [documentación](https://developers.deezer.com/api)

## Deployment

To deploy this project run

```bash
  php artisan migrate
  php artisan migrate --path="database/migrations/test/"
  php artisan db:seed
  cp .env.example .env
```

