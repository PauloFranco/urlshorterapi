How to set up the project:


Do a composer install


run the database migrations with php artisan migrate


send a post request to /hash (like http://127.0.0.1:8000/hash) with the body containing a JSON as: {"full_url":"https://www.youtube.com/"} (replace the URL with the URL you want)


To retrieve the URLS, you can use a GET resquest to /hash (like http://127.0.0.1:8000/hash)


To redirect to a website, you can use a GET request to /hash/{hash}, where {hash} is the shortcode generated when the POST request happened (you can check what it is using the GET request to /hash

