const { google } = require('googleapis');
const key = require('./musicsiteproject-a4a256ea7f3a.json');

const auth = new google.auth.GoogleAuth({
    keyFile: './musicsiteproject-a4a256ea7f3a.json',
    scopes: ['https://www.googleapis.com/auth/drive']
});

auth.getClient()
    .then(client => {
        const drive = google.drive({ version: 'v3', auth: client });

        // Отримання списку файлів та папок
        drive.files.list({
            pageSize: 10,
            fields: 'nextPageToken, files(id, name, mimeType)'
        }, (err, res) => {
            if (err) {
                console.error('Помилка отримання списку файлів:', err);
                return;
            }
            const files = res.data.files;
            if (files.length) {
                console.log('Список файлів та папок:');
                files.forEach(file => {
                    console.log(`${file.name} (${file.id}) - ${file.mimeType}`);
                });

                // Видалення папок по індетифікаторам
                /*const folderId = files[0].id;

                // Видалення папки
                drive.files.delete({
                    fileId: folderId
                }, (err, response) => {
                    if (err) {
                        console.error('Помилка видалення папки:', err);
                        return;
                    }
                    console.log('Папка видалена успішно.');
                });*/
            } else {
                console.log('Немає файлів або папок.');
            }
        });

        console.log('Успішно автентифіковано');
    })
    .catch(err => {
        console.error('Помилка автентифікації:', err);
    });


// Function to fetch audio files from Google Drive
async function fetchAudioFiles() {
    try {
        const response = await drive.files.get({
            fileId: '1yQPjn6m9-QPTINUiWr8X9FfPwJK-d4rN', // Replace 'YOUR_AUDIO_FOLDER_ID' with the actual folder ID containing your audio files
            fields: 'files(id, name, webViewLink)'
        });

        const audioFiles = response.data.files.map(file => ({
            id: file.id,
            title: file.name.replace(/\.[^/.]+$/, ""), // Remove file extension from name
            audioPath: file.webViewLink
        }));

        return audioFiles;
    } catch (error) {
        console.error('Error fetching audio files:', error);
        return [];
    }
}

// Function to fetch image files from Google Drive
async function fetchImageFiles() {
    try {
        const response = await drive.files.get({
            fileId: '1p6H5uhZTBmsswv5Ahpz_2-OlR8tDIi-G', // Replace 'YOUR_IMAGE_FOLDER_ID' with the actual folder ID containing your image files
            fields: 'files(id, webViewLink)'
        });

        const imageFiles = response.data.files.map(file => ({
            id: file.id,
            imagePath: file.webViewLink
        }));

        return imageFiles;
    } catch (error) {
        console.error('Error fetching image files:', error);
        return [];
    }
}