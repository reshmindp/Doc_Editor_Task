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

PUSHER_APP_ID=1942964
PUSHER_APP_KEY=e87364f70dda675fcbb1
PUSHER_APP_SECRET=5fcb09f09c3d8c916476
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=ap2

Run the Laravel Server

php artisan serve

Run Frontend Build & Watch for Changes

npm run dev
npm run watch
