# Vehicle Management System API

A RESTful API for managing vehicles, their attributes, and technical specifications. Built with Laravel, following SOLID principles and clean code practices.

## Table of Contents
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [API Documentation](#api-documentation)
- [Testing](#testing)
- [Project Structure](#project-structure)
- [API Endpoints](#api-endpoints)

## Prerequisites

Before you begin, ensure you have the following installed:
- Docker and Docker Compose
- Git
- Make (optional, but recommended for using Makefile commands)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd <project-directory>
```

2. Create a `.env` file from the example:
```bash
cp .env.example .env
```

3. Build and start the Docker containers:
```bash
make build
make up
```

4. Install dependencies:
```bash
make composer-install
```

5. Generate application key:
```bash
make artisan-key-generate
```

6. Run migrations and seed the database:
```bash
make setup
```

## Running the Application

The application runs in Docker containers. Here are the main commands:

```bash
# Start the application
make up

# Stop the application
make down

# View logs
make logs

# Restart the application
make restart
```

## API Documentation

The API documentation is available through Swagger UI. After starting the application, you can access it at: http://localhost:8000/api/documentation

### Using Swagger UI

1. Open the Swagger UI in your browser
2. Register a new user if you don't have one already
3. Obtain an access token by using the login endpoint
4. Click on the "Authorize" button at the top
5. Enter your Bearer token (obtained after login)
6. Click "Authorize"
7. You can now test all endpoints directly from the UI

### Authentication Flow

1. Register a new user:
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

2. Login to get a token:
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

3. Use the token in subsequent requests:
```bash
curl -X GET http://localhost:8000/api/vehicles/1 \
  -H "Authorization: Bearer your_token_here"
```

## Testing

The project includes comprehensive unit and integration tests. To run the tests:

```bash
# Run all tests
make test

# Run tests with coverage report
make test-coverage
```

The coverage report will be generated in the `coverage` directory. Open `coverage/index.html` in your browser to view the detailed report.

## Project Structure
```
├── app/
│ ├── Contracts/ # Service interfaces
│ ├── DTOs/ # Data Transfer Objects
│ ├── Http/
│ │ ├── Controllers/ # API Controllers
│ │ ├── Requests/ # Form Requests
│ │ └── Resources/ # API Resources
│ ├── Models/ # Eloquent Models
│ └── Services/ # Service implementations
├── database/
│ ├── migrations/ # Database migrations
│ └── seeders/ # Database seeders
├── tests/
│ ├── Unit/ # Unit tests
│ └── Feature/ # Integration tests
└── routes/
└── api.php
```
## API Endpoints

### Authentication
- `POST /api/register` - Register a new user
- `POST /api/login` - Login and get token
- `POST /api/logout` - Logout (requires authentication)

### Vehicles
- `GET /api/vehicles/{id}` - Get vehicle details
- `PATCH /api/vehicles/{id}/parameters` - Update vehicle parameter

### Vehicle Makes
- `GET /api/vehicle-types/{id}/makes` - Get makes by vehicle type

### Vehicle Attributes
- `GET /api/vehicle-attributes` - List all attributes
- `POST /api/vehicle-attributes` - Create new attribute
- `GET /api/vehicle-attributes/{id}` - Get attribute details
- `PUT /api/vehicle-attributes/{id}` - Update attribute
- `DELETE /api/vehicle-attributes/{id}` - Delete attribute

## Development

### Available Make Commands

```bash
# Docker commands
make up              # Start containers
make down           # Stop containers
make build          # Build containers
make restart        # Restart containers
make logs           # View logs

# Composer commands
make composer-install    # Install dependencies
make composer-update    # Update dependencies

# Artisan commands
make artisan-migrate        # Run migrations
make artisan-migrate-fresh  # Fresh migrations
make artisan-seed          # Run seeders
make artisan-cache-clear   # Clear cache
make artisan-route-clear   # Clear route cache
make artisan-view-clear    # Clear view cache
make artisan-optimize      # Optimize application
make artisan-generate-docs # Generate API documentation

# Test commands
make test           # Run tests
make test-coverage  # Run tests with coverage report

# Combined commands
make clear-all      # Clear all caches
make setup          # Fresh setup with seeders
```

### Code Style

The project follows PSR-12 coding standards. To check your code style:

```bash
make phpcs
```

To automatically fix code style issues:

```bash
make phpcbf
```