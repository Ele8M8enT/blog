document.addEventListener('DOMContentLoaded', function () {
    function checkForNewPost() {
        fetch('getLatestPost.php')
            .then(response => response.json())
            .then(data => {
                if (data.newPost) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error checking for new post:', error));
    }
    setInterval(checkForNewPost, 2000); 
});