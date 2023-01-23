## Steps to run the application

1. composer install
2. php artisan key:generate --ansi
3. php artisan migrate --seed (Change the mysql database credentials in the .env file)
4. php artisan serve

## API Endpoint
Use curl or postman to request to the API endpoint

1. Transfer Money (POST) - http://localhost:8000/api/v1/banks/transferM <br/>
curl -i -X POST -H "Content-Type: application/json" -d  "{\"account1\":1, \"account2\":2,\"amount\":100}" http://localhost:8000/api/v1/banks/transfer

2. Deposit Money (POST) - http://localhost:8000/api/v1/banks/deposit <br/>
curl -i -X POST -H "Content-Type: application/json" -d  "{\"account\":1, \"amount\":100}" http://localhost:8000/api/v1/banks/deposit

3. Withdraw Money (POST) - http://localhost:8000/api/v1/banks/withdraw <br/>
curl -i -X POST -H "Content-Type: application/json" -d  "{\"account\":2, \"amount\":100}" http://localhost:8000/api/v1/banks/withdraw

