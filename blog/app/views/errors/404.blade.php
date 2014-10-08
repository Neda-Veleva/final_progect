<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Error page</title>
    </head>
    <body>
        <h2>
            Server Error: 404 (Not Found)
        </h2>
        <hr>
        <h3>
            What does this mean?
        </h3>

        <p>
            We couldn't find the page you requested on our servers. We're really sorry
            about that. It's our fault, not yours. We'll work hard to get this page back online as soon as possible.
        </p>
        <p>
            Perhaps you would like to go to our {{ HTML::Link('/', 'Home Page') }}?
        </p>
    </body>
</html>