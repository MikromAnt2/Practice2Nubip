<?php
session_start();
$user_id = 0;
$user_name = "";
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorable Elastic Falcon</title>
    <meta property="og:title" content="Memorable Elastic Falcon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/home.css">

</head>
<body>

<div class="form_container form_normalizer   hide" id="form_container"> <!--Місце де вставляються форми-->
</div>
<div class="container">
    <div class="header_container">

        <input type="text" placeholder="Find a composition" class="header_input input">
        <div class="header_user_container">
            <?php if ($user_id != 0) : ?>

                <span class="interactive_menu_playlists_playlist_creator"> Welcome back <?php echo "User ID: $user_id"; ?></span>
                <button type="button" id="exit_btn" class=" user_entrance_button button">Exit</button>
            <?php else : ?>
                <button type="button" id="open_sign_in_form_btn" class=" user_entrance_button button left">Sign In</button>
                <button type="button" id="open_sign_up_form_btn" class=" user_entrance_button button">Sign Up</button>
            <?php endif; ?>
        </div>
    </div>
    <div class="interactive_menu_container">
        <div class="interactive_menu_buttons_container">
            <button name="Home_Btn" type="button" class="interactive_menu_button button" id="home_btn">
                <img alt="image" src="/images/info-panel/home_icon.png" class="interctive_menu_button_image">
                <span class="interactive_menu_button_text">Home</span>
            </button>
            <button name="Playlist_Btn" type="button" class="interactive_menu_button button">
                <img alt="image" src="/images/info-panel/playlist_icon.png" class="interctive_menu_button_image">
                <span class="interactive_menu_button_text">Library</span>
            </button>
            <button name="Favorites_Btn" type="button" class="interactive_menu_button button">
                <img alt="image" src="/images/info-panel/favorites_icon.png" class="interctive_menu_button_image">
                <span class="interactive_menu_button_text">Favorites</span>
            </button>
            <?php if ($user_id != 0) : ?>
            <button name="Upload_Btn" type="button" id="upload_music_btn" class="interactive_menu_button button">
                <img alt="image" src="/images/info-panel/Upload_icon.png" class="interctive_menu_button_image">
                <span class="interactive_menu_button_text">Upload</span>
            </button>
            <?php else: ?>
            <p></p>
            <?php endif; ?>
            <div class="interactive_menu_playlists_container <?php if ($user_id != 0) : ?> topper <?php endif; ?> "></div>
            <div class="border-half"></div>
            <?php if ($user_id != 0) : ?>
            <div class="interactive_menu_playlists_topic">
                <div class="interactive_menu_playlists_header">
                    <span class="interactive_menu_playlists_header_text">Playlists</span>
                    <button type="button" id="create_play_list" class="interactive_menu_playlists_header_button button">+</button>
                </div>
                <div class="playlists_container">
                    <?php include 'display_playlists.php'; ?>
                </div>

            </div>
            <?php endif; ?>
        </div>
        <div class="music_workspace">
            <span class="music_workspace_name">Recomendations</span>
            <div class="music_workspace_music">

            </div>
        </div>
    </div>
    <div class="music_player_sub_menu hide" id="music_menu"> <!-- Міні-Плеєр, з'являється коли користувач запускає трек -->
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
        <div class="music_player_sub_menu_controls">
            <button type="button" id="previous-song" class="music_player_sub_menu_control_button button">
                <img src="/images/info-panel/previous_song_icon.png" alt="image" class="music_player_sub_menu_control_button_image">
            </button>
            <button type="button" id="stop_button" class="music_player_sub_menu_control_button button">
                <img src="/images/info-panel/play_icon.png" alt="image" id="play_button_image" class="music_player_sub_menu_control_button_image">
            </button>
            <button type="button"  id="next-song" class="music_player_sub_menu_control_button button">
                <img src="/images/info-panel/next_song_icon.png" alt="image"   class="music_player_sub_menu_control_button_image">
            </button>
            <span id="music_timer" class="music_player_sub_menu_control_time">0:00</span>
            <span class="music_player_sub_menu_control_time">:</span>
            <span id="music_timer_duration" class="music_player_sub_menu_control_time">0:00</span>
        </div>
        <div class="music_player_sub_menu_music_info">
            <img src="/images/lorem.png" alt="image" class="music_player_sub_menu_music_info_image">
            <div class="music_player_sub_menu_music_info_description">
                <span class="music_player_sub_menu_music_info_description_name music_player_sub_menu_music_info_description_info">lorem ipslum</span>
                <span class="music_player_sub_menu_music_info_description_author music_player_sub_menu_music_info_description_info">lorem ipslum lorem ipslum</span>
            </div>
            <div class="music_player_sub_menu_music_user_menu">
                <button type="button" id="like_btn" class="music_player_sub_menu_music_user_menu_reaction_button button">
                    <img src="/images/info-panel/like_button_inactive.png" alt="image" id="like_picture" class="music_player_sub_menu_music_user_menu_reaction_img">
                </button>
                <button type="button" id="dislike_btn" class="music_player_sub_menu_music_user_menu_reaction_button button">
                    <img src="/images/info-panel/dislike_button_inactive.png" alt="image" id="dislike_picture" class="music_player_sub_menu_music_user_menu_reaction_img">
                </button>
                <button type="button" class="music_player_sub_menu_music_user_menu_sub_menu button">
                    <img src="/images/info-panel/user_submenu_icon.png" alt="image" class="music_player_sub_menu_music_user_menu_reaction_img">
                </button>
            </div>
        </div>
        <div class="music_player_sub_menu_music_redaction_menu">
            <input type="range" id="volumeSlider" class="volume-slider hide" min="0" max="1" step="0.01" value="1">
            <button type="button" id="sound_btn_replace" class="music_player_sub_menu_music_redaction_menu_button button">
                <img src="/images/info-panel/sound_icon.png" alt="image" id="sound" class="music_player_sub_menu_music_redaction_menu_button_image">
            </button>

            <button type="button"  class="music_player_sub_menu_music_redaction_menu_button button">
                <img src="/images/info-panel/mix_songs_icon.png" alt="image" id="random_button" class="music_player_sub_menu_music_redaction_menu_button_image">
            </button>
            <button type="button" id="repeat_button" class="music_player_sub_menu_music_redaction_menu_button button">
                <img src="/images/info-panel/replay_song_icon.png" alt="image" id="repeat_image" class="music_player_sub_menu_music_redaction_menu_button_image">
            </button>
            <button type="button" id="opened_button" class="music_player_sub_menu_music_redaction_menu_button button">
                <img src="/images/info-panel/close_player_icon.png" alt="image" class="music_player_sub_menu_music_redaction_menu_button_image opened_button_anim">
            </button>
        </div>
    </div>
</div>
<div class="music_player hide" id="music_player"><!--Ця менюшка з'являється коли відкривається пісня, її можна звернути і розвернути натисканням на панель знизу-->
    <div class="music_player_song" id="player_song">
        <img src="/images/lorem.png" class="music_player_song_img" alt="" id="player_song_img"> <!--Тут на скрипті впихнути картинку\відео теперішньої пісні-->
    </div>
    <div class="music_player_music-menu">
        <div class="music_player_music-menu_btns">
            <a href="#"button class="music_player_music-menu_next"><h3>Далі</h3></a>
            <a href="#"button class="music_player_music-menu_text"><h3>Текст</h3></a>
            <a href="#"button class="music_player_music-menu_same"><h3>Схожі</h3></a>
        </div>
        <div class="music_player_music-menu_next_song_container">

        </div>
    </div>
</div>

<script src="script/index.js"></script>
<script src="script/audio.js"></script>
<script src="app.js"></script>
<script>
    document.getElementById('exit_btn').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './form/logout.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    window.location.reload();
                } else {
                    console.error('Error closing session');
                }
            }
        };
        xhr.send();
    });
</script>
<script>
    const openSignInFormButton = document.getElementById("open_sign_in_form_btn");
    openSignInFormButton.addEventListener("click", () => {
        fetch('sign_in.html')
            .then(response => response.text())
            .then(data => {
                formContainer.classList.toggle("hide");
                document.getElementById('form_container').innerHTML = data;
            });
    })
</script>
<script>
    const openSignUpFormButton = document.getElementById("open_sign_up_form_btn");
    openSignUpFormButton.addEventListener("click", () =>{
        fetch('sign_up.php')
            .then(response => response.text())
            .then(data => {
                formContainer.classList.toggle("hide");
                document.getElementById('form_container').innerHTML = data;
            });
    })
</script>
<script>
    const HomeBtn = document.getElementById('home_btn');
    const Playlist = document.querySelectorAll(".interactive_menu_playlists_playlist");

    HomeBtn.addEventListener('click', ()=>{
        window.open('index.php');
    })
    Playlist.forEach(playlist => {
        playlist.addEventListener("click", () => {
            this.window.open('form/playlists.php');
        });
    });

</script>
</body>
</html>
