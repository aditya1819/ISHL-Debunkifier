# Debunkify

Debunkify is an interactive web application designed to help users learn how to identify and debunk fake news. The platform provides structured tutorials and exercises to develop critical thinking and media literacy skills in a supportive digital environment.

## 🧠 Project Mentor Review

> *“The team has delivered a thoughtful and structured approach to tackling the complex challenge of fake news detection through interactive learning. The design successfully breaks down a difficult and often overwhelming topic into scaffolded, manageable stages, allowing users to gradually build critical thinking and media literacy skills in a supportive digital environment. Good job overall.”*

## 🚀 Features

* **User Registration & Login**
* **Step-by-Step Tutorials** on fake news detection
* **Interactive Exercises** to practice learned skills
* **Progressive Learning Flow** from basics to advanced topics
* **Media Literacy Building Tools**

## 🔧 Tech Stack

* **Framework**: Laravel
* **Frontend**: Vite
* **Database**: SQLite
* **Containerization**: Docker (Dockerfile included)

## 🐳 Docker Setup

To run the application using Docker:

```bash
docker build -t debunkify-app .
docker run -p 8000:8000 debunkify-app
```

Ensure that Docker is installed and running on your machine.

## 📂 Local Development

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/debunkify.git
   cd debunkify
   ```

2. Setup Env file

2. Install dependencies:

   ```bash
   composer install
   npm install && npm run dev
   ```

3. Setup SQLite database:

   ```bash
   touch database/database.sqlite
   cp .env.example .env
   php artisan migrate
   ```

4. Start the server:

   ```bash
   php artisan serve
   ```

## 🌐 Hosted Version

To access the hosted version of the application, please email:
📧 **[shahare.aditya@gmail.com](mailto:shahare.aditya@gmail.com)**

## 👤 New Users

To get started:

* **Register an account**
* Begin the **interactive tutorials**
* Complete **exercises** and build your media literacy

## 📃 License

MIT License. See [LICENSE](https://opensource.org/licenses/MIT) for more details.

## Application Images

### Dashboard

![Image](https://github.com/user-attachments/assets/7a68c115-d041-4864-a680-4126c28a2b45)

### Tutorials
![Image](https://github.com/user-attachments/assets/ac188c45-74dd-4a07-8051-023d6dcd9349)

### Tutorial
![Image](https://github.com/user-attachments/assets/85c2dd77-6215-49c0-a3f1-eca6ff11b2fa)

### Jump to exercise
![Image](https://github.com/user-attachments/assets/6445643d-64a6-4cab-9574-55fab2fd57c8)

### Exercises
![Image](https://github.com/user-attachments/assets/b24c84b7-bbac-47df-8806-9eb725b42f8b)

### Exercise
![Image](https://github.com/user-attachments/assets/623f3d38-05e6-401c-ae70-9393275c92ad)

### Checklist
![Image](https://github.com/user-attachments/assets/276bfc89-49f5-4c81-8d87-a545c8f7377f)

### Expert Solution
![Image](https://github.com/user-attachments/assets/dbc59408-0da2-4b8f-9dea-f4f669709d18)
