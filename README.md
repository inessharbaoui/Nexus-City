# Nexus-City

A unified analytics dashboard for urban management, integrating traffic flow, public transport, energy consumption, and weather data into a single, powerful platform.

## Table of Contents

* [About the Project](#about-the-project)
* [Features](#features)
* [Tech Stack](#tech-stack)
* [Getting Started](#getting-started)

  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
  * [Running Locally](#running-locally)
* [Usage](#usage)
* [Screenshots & Demo](#screenshots--demo)
* [Roadmap](#roadmap)
* [Contributing](#contributing)
* [Contact](#contact)

## About the Project

Nexus-City is a modern web application built to provide city administrators and planners with real-time and historical insights across multiple urban systems. By unifying traffic analytics, public transport management, energy monitoring, and weather integration, Nexus-City enables data-driven decision-making for more efficient and sustainable urban operations.

## Features

* **Traffic Analytics**: Real-time vehicle counts, congestion patterns, speed distribution, and route optimization suggestions.
* **Public Transport Management**: Interactive route maps, live vehicle tracking, service optimization, and coverage analysis.
* **Energy Monitoring**: Consumption charts, peak hour analysis, predictive forecasting, and efficiency metrics.
* **Weather Integration**: Current conditions, short-term forecasts, seasonal trend analysis, and climate impact insights.

## Tech Stack

**Backend:**

* Laravel (PHP)
* MySQL

**Frontend:**

* Vue.js
* Blade Templates
* JavaScript (ES6+)

**Real-time & Maps:**

* Laravel Echo / WebSockets
* Leaflet.js / OpenStreetMap

**Charts & Data Viz:**

* Chart.js

## Getting Started

Follow these steps to set up Nexus-City on your local machine.

### Prerequisites

* PHP 7.4 or higher
* Composer
* Node.js & npm
* MySQL 5.7 or higher
* Git

### Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/inessharbaoui/Nexus-City.git
   cd Nexus-City
   ```
2. **Install backend dependencies**

   ```bash
   composer install
   ```
3. **Install frontend dependencies**

   ```bash
   npm install
   ```
4. **Set up environment file**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. **Configure your `.env`**

   * Database settings
   * API keys for weather/traffic services
6. **Run migrations and seeders**

   ```bash
   php artisan migrate --seed
   ```

### Running Locally

Start the application with:

```bash
npm run dev   # Compile assets
php artisan serve  # Start Laravel dev server
```

Visit `http://localhost:8000` in your browser.

## Usage

* **Dashboard Overview**: View integrated metrics for traffic, transport, energy, and weather.
* **Interactive Maps**: Pan and zoom city maps to inspect real-time locations.
* **Filter & Export**: Apply date or location filters, then export charts as images or CSV.

## Screenshots & Demo

![Dashboard Screenshot](screenshots/dashboard.png)

**Live Demo Video:** [Watch on YouTube](https://youtu.be/your-demo-link)

## Roadmap

* [ ] Machine Learning for predictive analytics
* [ ] Native mobile app (iOS/Android)
* [ ] Public API for third-party integrations
* [ ] Alerting & notification system
* [ ] Multi-city deployment support

## Contributing

We welcome contributions! To get started:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/YourFeature`
3. Commit your changes: `git commit -m 'Add YourFeature'`
4. Push to your branch: `git push origin feature/YourFeature`
5. Open a Pull Request

Contributing guidelines will be added here soon. In the meantime, feel free to open issues or pull requests with your ideas or improvements.

## Contact

**Project Lead:** Iness Harbaoui

* GitHub: [@inessharbaoui](https://github.com/inessharbaoui)
* LinkedIn: [Iness Harbaoui](https://linkedin.com/in/iness-harbaoui-969298279)
* Email: [ines.harbaoui.ih@gmail.com](mailto:ines.harbaoui.ih@gmail.com)

---

⭐ If you find this project useful, please give it a star!
