# 🌦️ Weather Forecast API

This is a simple Weather Forecast API built with PHP and MySQL.  
It retrieves real-time weather data using OpenWeatherMap and allows users to store and manage forecasts in a local database.

---

## 📂 **Project Structure**
```
weather-app/
 ├── config/             # Configuration files (database, environment)
 │    ├── config.php     # Returns configuration settings
 │    ├── dotenv.php     # Loads environment variables
 ├── models/             # Database models
 │    ├── Forecast.php   # Handles forecast-related operations
 │    ├── Location.php   # Manages locations in the database
 ├── services/           # Business logic layer
 │    ├── WeatherService.php  # Handles weather data retrieval
 ├── controllers/        # Handles API requests
 │    ├── ForecastController.php  # Manages forecast-related requests
 ├── storage/            # Storage for cache and logs
 │    ├── cache/         # Stores temporary data
 │    ├── logs/          # Stores application logs
 ├── tests/              # Unit and integration tests
 │    ├── Unit/          # Unit tests
 │    │    ├── LocationTest.php
 │    │    ├── WeatherServiceTest.php
 │    ├── Integration/   # Integration tests
 │    │    ├── DatabaseTest.php
 │    │    ├── ForecastTest.php
 │    ├── bootstrap.php  # Initializes PHPUnit test environment
 ├── public/             # Public-facing files (entry points)
 ├── vendor/             # Composer dependencies
 ├── .env                # Environment variables (API key, DB config)
 ├── composer.json       # PHP dependencies
 ├── README.md           # Project documentation
```

---

## 🛠 **Setup & Installation**

### 1️⃣ **Clone the Repository**
```sh
git clone https://github.com/LxrdCrow/weather-app.git
cd weather-app
```

### 2️⃣ **Install Dependencies**
```sh
composer install
```

### 3️⃣ **Set Up Environment Variables**
Create a `.env` file in the root directory and configure it as follows:
```env
DB_HOST=localhost
DB_NAME=weather_app
DB_USER=root
DB_PASSWORD=
API_KEY=your_openweathermap_api_key
APP_DEBUG=true
BASE_URL=http://localhost:8000
```
⚠️ Replace `your_openweathermap_api_key` with a valid API key from [OpenWeatherMap](https://openweathermap.org/api).

### 4️⃣ **Configure the Database**
Create a MySQL database and import the `database.sql` file:
```sh
mysql -u root -p weather_app < database.sql
```

### 5️⃣ **Run the Application**
Use PHP's built-in server:
```sh
php -S localhost:8000 -t public
```

---

## 🚀 **Usage**

### **1️⃣ Fetch Weather Data**
#### **GET** `/forecast/{city}`
Example:
```sh
curl -X GET "http://localhost:8000/forecast/Messina"
```
📌 **Response**
```json
{
  "main": {
    "temp": 15.5
  },
  "weather": [
    {
      "description": "clear sky"
    }
  ]
}
```

### **2️⃣ Save a Forecast**
#### **POST** `/forecast/save/{city}`
Example:
```sh
curl -X POST "http://localhost:8000/forecast/save/Rome"
```
📌 **Response**
```json
{
  "message": "Forecast saved successfully"
}
```

---

## ✅ **Testing**
Run **unit & integration tests** using PHPUnit:
```sh
vendor/bin/phpunit
```

---

## 📝 **To-Do**
- [ ] Implement user authentication 🔐  
- [ ] Add historical weather data storage 📊  
- [ ] Create a front-end interface with React ⚛️  

---

## 🤝 **Contributing**
Contributions are welcome! Feel free to open an issue or submit a pull request.

---

## 📜 **License**
This project is licensed under the **MIT License**.
```


