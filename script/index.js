const replaceBtn = document.querySelector("#sound_btn_replace");
const player = document.querySelector("#music_player");
const soundImg = document.querySelector("#sound");
const musicMenu = document.querySelector("#music_menu");
const likeButton = document.getElementById("like_btn");
const dislikeButton = document.getElementById("dislike_btn");
const likeImage = document.getElementById("like_picture");
const dislikeImage = document.getElementById("dislike_picture");
const volumeSliderContainer = document.querySelector(".volume-slider-container");
const volumeSlider = document.getElementById("volumeSlider");
const repeatButton = document.getElementById("repeat_button");
const repeatImg = document.getElementById("repeat_image");
const openedButton = document.querySelector('#opened_button');
const openedButtonAnimation = document.querySelector('.opened_button_anim');
const formContainer = document.getElementById("form_container");
const openUploadMusicButton = document.getElementById("upload_music_btn");
const openCreatePlaylistButton = document.getElementById("create_play_list");




let inputChanged = false;

openedButton.addEventListener('click', () => {
    openedButtonAnimation.classList.toggle('opened');
});
likeButton.addEventListener("click", (event) => {
    if (likeImage.src.includes("/images/info-panel/like_button_inactive.png")) {
        likeImage.src = likeImage.src.replace("/images/info-panel/like_button_inactive.png", "/images/info-panel/like_button_active.png");
    } else {
        likeImage.src = likeImage.src.replace("/images/info-panel/like_button_active.png", "/images/info-panel/like_button_inactive.png");
    }
    dislikeImage.src = "/images/info-panel/dislike_button_inactive.png";
});

dislikeButton.addEventListener("click", (event) => {
    if (dislikeImage.src.includes("/images/info-panel/dislike_button_inactive.png")) {
        dislikeImage.src = dislikeImage.src.replace("/images/info-panel/dislike_button_inactive.png", "/images/info-panel/dislike_button_active.png");
    } else {
        dislikeImage.src = dislikeImage.src.replace("/images/info-panel/dislike_button_active.png", "/images/info-panel/dislike_button_inactive.png");

    }
    likeImage.src = "/images/info-panel/like_button_inactive.png";
});

openedButton.addEventListener("click", () => {
    player.classList.toggle("hide");
});

replaceBtn.addEventListener("click", () => {
    currentAudio.muted = !currentAudio.muted;
    localStorage.setItem('isMuted', currentAudio.muted.toString());

    updateSoundIcon();
});
function updateSoundIcon() {
    if (currentAudio.muted) {
        soundImg.src = soundImg.src.replace("/images/info-panel/sound_icon.png", "/images/info-panel/nosound_icon.png");
    } else {
        soundImg.src = soundImg.src.replace("/images/info-panel/nosound_icon.png", "/images/info-panel/sound_icon.png");
    }
}
volumeSlider.addEventListener("input", () => {
    const volume = volumeSlider.value;
    currentAudio.volume = volume;
    localStorage.setItem('volume', volume);
    inputChanged = true;
});
replaceBtn.addEventListener("mouseenter", () => {
    volumeSlider.classList.remove("hide"); // Show the volume slider container on hover
});

// volumeSliderContainer.addEventListener("mouseleave", () => {
//     const isInsideVolumeSlider = volumeSliderContainer.contains(document.activeElement);
//     if (!isInsideVolumeSlider){
//         volumeSlider.classList.add("hide");
//     }
//     if (inputChanged){
//         volumeSlider.classList.add("hide");
//         inputChanged = false;
//     }
// });

volumeSlider.addEventListener("input", () => {
    const volume = volumeSlider.value;
    currentAudio.volume = volume;

    if (volume > 0) {
        soundImg.src = '/images/info-panel/sound_icon.png';
    } else {
        soundImg.src = '/images/info-panel/nosound_icon.png';
    }
});
repeatButton.addEventListener("click", () => {
   if (repeatImg.src.includes("/images/info-panel/replay_song_icon.png")){
       repeatImg.src = repeatImg.src.replace("/images/info-panel/replay_song_icon.png","/images/info-panel/replay_song_icon_clicked.png");
   }
   else {
       repeatImg.src = repeatImg.src.replace("/images/info-panel/replay_song_icon_clicked.png", "/images/info-panel/replay_song_icon.png");
   }
});
openUploadMusicButton.addEventListener("click", () =>{
    fetch('add_music.html')
        .then(response => response.text())
        .then(data => {
            formContainer.classList.toggle("hide");
            document.getElementById('form_container').innerHTML = data;
        });
})
openCreatePlaylistButton.addEventListener("click", () =>{
    fetch('user_create_playlist.php')
        .then(response => response.text())
        .then(data => {
            formContainer.classList.toggle("hide");
            document.getElementById('form_container').innerHTML = data;
        });
})

