
# Ticket Notification System

I developed a robust ticket notification system that automates alerts for support tickets, ensuring timely updates and efficient issue tracking. The system integrates seamlessly with our existing tools, enhancing communication and response times.

### Index View
![GitHub Logo](https://github.com/Danish1042/Ticket-Notification-System/blob/main/index%20snapshot.jpeg)

### Book Ticket
![GitHub Logo](https://github.com/Danish1042/Ticket-Notification-System/blob/main/Book%20Ticket%20Snapshot.jpeg)

### All Boked Tickets
![GitHub Logo](https://github.com/Danish1042/Ticket-Notification-System/blob/main/All%20Booked%20ticket%20snapshot.jpeg)

### Geeting All the mails/reminders
![GitHub Logo](https://github.com/Danish1042/Ticket-Notification-System/blob/main/mailtrap%20snapshot.jpeg)

## Run Locally

Clone the project

```bash
  git clone https://github.com/Danish1042/Ticket-Notification-System
```

Go to .env file and set the database

```bash
  DB_DATABASE=ticket_notification_system
```

Run migration command

```bash
  php artisan migrate:fresh --seed
```

Start the server

```bash
  php artisan serve
```
Run the NPM

```bash
  npm run dev
```
Run the Scheduler
##### Running the Scheduler in Laravel involves setting up a single Cron entry on the server to call the schedule:run Artisan command every minute. This command evaluates your scheduled tasks defined in the app/Console/Kernel.php file and executes them accordingly.
####
```bash
  php artisan notify:notify
```
Call Queue Worker
##### The Call Queue Worker in Laravel processes queued jobs in the background, improving application performance by offloading time-consuming tasks. It listens for new jobs on a specified queue and handles them efficiently, ensuring smooth operation and responsiveness.
####
```bash
  php artisan queue:work
```

## Support

For support, email rajadanish2321@gmail.com .


## Authors

- [@Danish1042](https://github.com/Danish1042)


 
