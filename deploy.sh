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
php artisan migrate --seed
