stack:
php: 8.3
npm: 8.18.0
node: 22.2.0

instalacja:
- tworzymy .env z .env.example
- dodajemy bazę danych w .env
- php artisan key:generate
- php artisan optimize
- php artisan migrate

odpalamy procesy php i w konsoli odpalamy npm

- npm i
- npm run dev // dla dev