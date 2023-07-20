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

