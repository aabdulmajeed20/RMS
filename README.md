# Report Management System




# How it works

First you should have Laravel and NPM installed in your system.
After cloning the project, Run the below command to install composer dependencies
> composer install

Then Run npm commands:
> npm install
> npm run dev

After That you should create a database and name it **rms**
After created the database, run this command:
> php artisan migrate

This wil generate the tables of the database.
After initiating the database, if you need to add dummy data to fill the database, run this command:
> php artisan db:seed

Finally, To start the development server, run:
> php artisan serve

And here we go! You can now use the Application.

## How to use it
The system has users with different roles. an Admin user will be generated automatically with this credentials
**Email: Admin@rms.com**
**Password: Admin**
You can create users from **Settings** page that located in dropdown list (click on the name on the right in navbar)

## Notes

Regarding to the **Authorization**, The user has access on the reports as following:
- List all reports that related to the assigned group
- Show each report in related Group
- Create new Report
- Update and Delete only the owned Report (User can't update or delete other users' reports)

User can't access reports in the groups that he's not part of them.

## Demo
[Click Here]() to access the demo of the application.