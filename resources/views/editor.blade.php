<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrapeJS Page Builder</title>
    <!-- Include GrapeJS styles -->
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
</head>
<body>
    <div id="gjs"></div>
    <button onclick="savePage()">Save Page</button>
    <div id="savedPages"></div>
    <!-- Include GrapeJS scripts -->
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Initialize GrapeJS -->
    <script>
        var editor = grapesjs.init({
            container: '#gjs',
            // Other configurations
            storageManager: {
                autoload: true,
                type: 'local',
                id: 'your-project-id',
            },
        });

        function savePage() {
            var pageData = editor.getHtml(); // Get the HTML content of the page
            var pageStyles = editor.getCss(); // Get the CSS content of the page

            // Send the data to the server
            $.ajax({
                type: 'POST',
                url: '/save-page',
                data: {
                    html: pageData,
                    css: pageStyles
                },
                success: function(response) {
                    console.log('Page saved successfully');
                    // Refresh saved pages list
                    loadSavedPages();
                },
                error: function(xhr, status, error) {
                    console.error('Error saving page:', error);
                }
            });
        }

        function loadSavedPages() {
            // Load saved pages from the server
            $.ajax({
                type: 'GET',
                url: '/get-saved-pages',
                success: function(response) {
                    $('#savedPages').empty();
                    response.forEach(function(page) {
                        $('#savedPages').append('<div>' + page.title + '</div>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading saved pages:', error);
                }
            });
        }

        // Load saved pages on initial page load
        loadSavedPages();
    </script>
</body>
</html>
