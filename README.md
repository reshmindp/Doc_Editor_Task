Technologies Used

Backend: Laravel 11
Frontend: Bootstrap 5, JavaScript
Database: MySQL
Real-Time Communication: Pusher, Laravel Echo
Queue Management: Laravel Queues (Database Queue Driver)
Task Scheduling: Laravel Scheduler
Authentication: Laravel Sanctum
Editor: Summernote (WYSIWYG Editor)

Install Dependencies

composer install
npm install

Set Up Environment Variables

BROADCAST_DRIVER=pusher

PUSHER_APP_ID= 
PUSHER_APP_KEY= 
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER= 

Run the Laravel Server

php artisan serve

Run Frontend Build & Watch for Changes

npm run dev
npm run watch
