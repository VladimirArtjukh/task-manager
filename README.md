# Task Manager Application

A simple web-based task manager built with Laravel and Vue.js, featuring a RESTful API backend and a responsive frontend.

## Features
- Add, edit, delete, and mark tasks as complete
- Responsive design with Bootstrap styling
- RESTful API with proper HTTP status codes
- Client-side routing with Vue Router
- Dynamic route generation with Ziggy
- Persistent data storage in MySQL
- Unit tests for backend functionality

## Project Structure
- `Modules/` - Laravel backend code
- `resources/js/` - Vue frontend components and app setup
- `resources/css/` - CSS files including Bootstrap
- `tests/` - Unit tests
- `database/` - Database migrations
- `routes/` - API route definitions

## Prerequisites
- Docker
- Docker Compose

## Setup Instructions
1. Clone the repository:
   ```bash
   git clone https://github.com/VladimirArtjukh/task-manager
   cd task-manager
   make install


## Running the Application
- Access the application at `http://localhost`
- Run tests with `make test`
- Stop the application with `make down`

## API Documentation
API documentation is available in the `Task manager.postman_collection.json` file.
Import it into Postman to view all endpoints and their specifications.

## Notes
- The application uses Laravel Sail for development
- MySQL is used as the database
- Vue.js handles the frontend with responsive design
- Basic error handling and validation are implemented
