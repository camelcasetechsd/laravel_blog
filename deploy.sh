composer install 

#for node_modules
npm install --global gulp
npm install 

#for bootstrap and Jquery 
bower install

#preparing scripts & style-sheets
gulp

#preparing DB
php artisan droptables

#adding jobs migration class
php artisan queue:table

# migrating table classes
php artisan migrate

#seeding tables 
php artisan migrate --seed

#registering jobs to jobs table
./jobs.sh

