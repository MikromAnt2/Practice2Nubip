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
    <title>Playlists</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>

<body>

<div class="form_container form_normalizer   hide" id="form_container"> <!--Місце де вставляються форми-->
</div>
<div class="container">
    <div class="header_container">
        <button type="button" name="play_node_button" id="play_node_button" class="header_interactive_menu_button button">
            <img alt="image" src="/images/info-panel/music_player_template_buttons.png" class="home_interactive_menu_button_image">
        </button>
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
            <button name="Upload_Btn" type="button" id="upload_music_btn" class="interactive_menu_button button">
                <img alt="image" src="/images/info-panel/Upload_icon.png" class="interctive_menu_button_image">
                <span class="interactive_menu_button_text">Upload</span>
            </button>
            <div class="interactive_menu_playlists_container"></div>
            <div class="interactive_menu_playlists_topic">
                <div class="border-half"></div>
                <div class="interactive_menu_playlists_header">
                    <span class="interactive_menu_playlists_header_text">Playlists</span>
                    <button type="button" id="create_play_list" class="interactive_menu_playlists_header_button button">+</button>
                </div>
                <div class="playlists_container">
                    <?php include '../display_playlists.php'; ?>
                </div>

            </div>
        </div>

        <div class="player_workspace">
            <div class="playlist_container">
                <div class="playlist_header_col">
                <div class="playlist_header">
                    <img src="/images/lorem.png" class="playlist_header_image">
                    <div class="playlist_header_col">
                    <span class="playlist_header_text">Lorem Ipslum</span>
                    <span class="playlist_header_subtext">Lorem Ipslum</span>
                    </div>
                </div>
                    <div class="playlist_header_row">
                        <button class="player_header_listen_btn"><img src="/images/info-panel/play_icon.png" alt="" srcset="" class="player_header_listen_btn_image"><span class="player_header_listen_btn_text">Listen</span></button>
                        <button class="player_header_redact_btn"><img src="/images/info-panel/user_submenu_icon.png" alt="" srcset="" class="player_header_listen_btn_image_red"><span class="player_header_listen_btn_text">Redact</span></button>
                    </div>
                </div>
            <div class="playlist_music_list">
                <div class="playlist_music_list_template">
                    <span class="playlist_music_list_text">Image</span>
                    <span class="playlist_music_list_text">Track</span>
                    <span class="playlist_music_list_text">Artist</span>
                    <img src="/images/forms/time_img.png" alt="Image" class="playlist_music_list_img"/>
                </div>
                <div class="playlist_music_list_add_track" id='playlist_music_add'>
                    <button class="playlist_music_list_songs_add_btn">+</button>
                <span class="playlist_music_list_text">Add Song</span>
            </div>
                <div class="playlist_music_list_container">
                        <img src="/images/lorem.png" alt="Image" class="playlist_music_list_songs_container_image"/>
                        <span class="playlist_music_list_text">Lorem</span>
                        <span class="playlist_music_list_text">Lorem</span>
                        <span class="playlist_music_list_text">Lorem</span>
                </div>


            </div>

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
                <img src="/images/info-panel/play_icon.png" alt="image" class="music_player_sub_menu_control_button_image">
            </button>
            <button type="button"  id="next-song" class="music_player_sub_menu_control_button button">
                <img src="/images/info-panel/next_song_icon.png" alt="image" id="play_button_image"  class="music_player_sub_menu_control_button_image">
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
    loadToPlayer = document.getElementById('playlist_music_add')
    loadToPlayer.addEventListener('click' =>{
        window.open('.add_to_Playlists.php');
    })

</script>
<script>
    document.getElementById('exit_btn').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '.logout.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Сесія закрита успішно, перезавантажимо сторінку
                    window.location.reload();
                } else {
                    // Помилка при закритті сесії
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
        fetch('../sign_in.html')
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
        fetch('../sign_up.php')
            .then(response => response.text())
            .then(data => {
                formContainer.classList.toggle("hide");
                document.getElementById('form_container').innerHTML = data;
            });
    })
</script>
<script>
    const AddToPlaylist = document.getElementById('playlist_music_add');
    const HomeBtn = document.getElementById('home_btn');
    const Playlist = document.querySelectorAll(".interactive_menu_playlists_playlist");
    AddToPlaylist.addEventListener('click', () =>{
        window.open('add_to_Playlist.html')
    })
    HomeBtn.addEventListener('click', ()=>{
        window.open('../index.php');
    })
    Playlist.forEach(playlist => {
        playlist.addEventListener("click", () => {
            window.open('playlists.php');
        });
    });

</script>
</body>
</html>