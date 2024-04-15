$(document).ready(function() {
    $('#searchForm').submit(function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the search term entered by the user
        var searchTerm = $('#searchInput').val();

        // AJAX request to fetch data from the server
        $.ajax({
            url: 'search.php', // PHP file to handle the request
            type: 'GET',
            data: { query: searchTerm },
            success: function(response) {
                // Display the search results
                $('#searchResults').html(response);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText+"hello");
            }
        });
    });
});
