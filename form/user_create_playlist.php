<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/css/create_playlist.css">
</head>
<body>
<form action="create_playlist.php" method="post">
    <div class="create_playlist_form">
        <h2 class="create_playlist_form_heading">Create Playlist</h2>
        <div class="create_playlist_input_container">
            <div class="create_playlist_form_container">
                <label class="create_playlist_name_text">Name</label>
                <input type="text" id="playlist_name" required = "true" placeholder="Enter playlist name" class="create_playlist_forms_input" name="playlist_name">
            </div>
            <div class="create_playlist_form_container">
                <label class="create_playlist_name_text">Description</label>
                <input type="text" id="playlist_description" placeholder="Enter description" class="create_playlist_forms_input" name="playlist_description">
            </div>
            <div class="create_playlist_btn_container">
                <button type="submit" class="create_playlist_button signbutton"><span name = "create_playlist">Create Playlist</span></button>
            </div>
        </div>
    </div>
</form>
</body>
</html>