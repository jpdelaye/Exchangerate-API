# Exchangerate-API
REST API interface delivering fiat currency and crypto exchange rate data.

The REST API interface built with CodeIgniter 4 framework acts as a bridge between your application and external APIs. It fetches exchange rate data from coinmarketcap.com and coingecko.com, storing it in a database for efficient usage of API credits. This caching mechanism reduces the need for frequent API requests, optimizing performance and costs.

The service offers real-time exchange rate data for both fiat currencies and cryptocurrencies, making it a valuable resource for developers, traders, and financial applications. Third-party users can access this data through your API, empowering them to integrate accurate and up-to-date exchange rates into their own applications and services. 



Sure, here are the installation steps for setting up the REST API interface for fiat currency and crypto exchange rate data:

1. Clone or download the repository and upload it to your server or development environment.

2. Create a `.env` file in the root directory of the project. Add your API keys for coinmarketcap.com and coingecko.com in this file as follows:
```
COINMARKETCAP_API_KEY=your_coinmarketcap_api_key
COINGECKO_API_KEY=your_coingecko_api_key
```

3. Configure your database credentials in the same `.env` file:
```
DATABASE_HOST=your_database_host
DATABASE_USER=your_database_username
DATABASE_PASS=your_database_password
DATABASE_NAME=apiexchangeDB
```

4. Import the MySQL database structure using the provided `apiexchangeDB.sql` file. This will set up the necessary tables to store the exchange rate data.

5. Once the database is set up, the API is ready to use. You can start making requests to retrieve fiat currency and crypto exchange rate data.

Please note that it's crucial to keep your `.env` file secure, as it contains sensitive information like API keys and database credentials. Make sure not to expose it publicly or include it in version control systems.

After following these installation steps, your REST API interface should be up and running, providing access to exchange rate data and serving third-party users with accurate and up-to-date information.

To keep your database updated with the latest exchange rate data and ensure efficient usage of API credits, create a cronjob that points to the API endpoint at `localhost/v1/getter/0xdac17f958`. Since you are limited to 10,000 credits per month on the free API plan like in coinmarketcap.com, it's recommended to execute the cronjob approximately every 5 minutes.

Here's an example of how to set up the cronjob on a Unix/Linux system:

1. Open your terminal or SSH into your server.

2. Edit the crontab file using the following command:
```
crontab -e
```

3. Add a new line to schedule the cronjob. For running the cronjob every 5 minutes, use the following entry:
```
*/5 * * * * curl http://localhost/v1/getter/0xdac17f958
```
This command will execute the `curl` request to the specified API endpoint every 5 minutes, updating your database with the latest exchange rate data for the given cryptocurrency (0xdac17f958 in this example).

4. Save the crontab file and exit the text editor.

With this cronjob in place, your database will be regularly updated with fresh exchange rate data, while also staying within the API credit limits to prevent exceeding the free tier's allowance.

 
# Available Endpoints

  The API comes with a number of endpoints where each of them provides different functionality. 

To retrieve the latest exchange rate data for all cryptocurrencies. The endpoint is: 

```
   http://rates.intelector.com/v1/cryptocurrencies 
```

Will deliver a JSON response:

```   
{
    "data": [
        {
            "id": "1",
            "codeID": "1",
            "symbol": "BTC",
            "price_usd": "29763.383835225",
            "price_mxn": "501342.47343414",
            "percent_change_24h": "-0.47498728",
            "percent_change_1h": "-0.21963587",
            "platform": "",
            "token_address": "",
            "name": "Bitcoin",
            "last_updated": "2023-07-20 10:30:01"
        },
        {
            "id": "2",
            "codeID": "52",
            "symbol": "XRP",
            "price_usd": "0.79014423139021",
            "price_mxn": "13.309402772478",
            "percent_change_24h": "-1.07357777",
            "percent_change_1h": "-0.27371891",
            "platform": "",
            "token_address": "",
            "name": "XRP",
            "last_updated": "2023-07-20 10:30:01"
        },
        // Other cryptocurrencies data...
  ]
}
```

This JSON response will now contain an array of objects, each representing a different cryptocurrency. The objects will include various details like the cryptocurrency symbol, name, price in USD and MXN, percentage changes in price over the last 1 hour, 24 hours, and the timestamp of the last update.
    
```
    http://rates.intelector.com/v1/cryptocurrencies/usdt 
```

Will deliver a JSON response with the latest exchange rate for the specified cryptocurrency (USDT in this case). Here's how the JSON response might look like:
 
  
  ```
        
 {
    "data": [
        {
            "id": "3",
            "codeID": "825",
            "symbol": "USDT",
            "price_usd": "0.99986625728194",
            "price_mxn": "16.842017201546",
            "percent_change_24h": "-0.01136369",
            "percent_change_1h": "0.00279715",
            "platform": "Ethereum",
            "token_address": "0xdac17f958d2ee523a2206206994597c13d831ec7",
            "name": "Tether",
            "last_updated": "2023-07-20 10:30:01"
        }
    ],
    "code": "200"
}

```

 

