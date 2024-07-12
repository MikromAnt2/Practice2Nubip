const { google } = require('googleapis');
const fs = require('fs');
const key = require('./musicsiteproject-a4a256ea7f3a.json');

const auth = new google.auth.GoogleAuth({
    keyFile: './musicsiteproject-a4a256ea7f3a.json',
    scopes: ['https://www.googleapis.com/auth/drive']
});

auth.getClient()
    .then(client => {
        const drive = google.drive({ version: 'v3', auth: client });
        async function fetchFilesByIds(fileIds) {
            try {
                const files = [];
                for (const fileId of fileIds) {
                    const response = await drive.files.get({
                        fileId: fileId,
                        fields: 'id, webViewLink'
                    });
                    files.push({
                        id: response.data.id,
                        webViewLink: response.data.webViewLink
                    });
                }
                return files;
            } catch (error) {
                console.error('Помилка отримання файлу з Google Drive:', error);
                return [];
            }
        }

        const musicFolderId = '1yQPjn6m9-QPTINUiWr8X9FfPwJK-d4rN';
        const imageFolderId = '1p6H5uhZTBmsswv5Ahpz_2-OlR8tDIi-G';

        Promise.all([
            fetchFilesByIds(['17xmlE-9PM4jXKCypS7USlkm227kFUwn5']),
            fetchFilesByIds(['15d4zbnIZEA9MQmt9rPMSoPXsbS3LVOWX'])
        ]).then(([musicFiles, imageFiles]) => {
            console.log('Музичні файли:', musicFiles);
            console.log('Зображення:', imageFiles);
        }).catch(error => {
            console.error('Помилка отримання файлів:', error);
        });

        console.log('Успішно автентифіковано');
    })
    .catch(err => {
        console.error('Помилка автентифікації:', err);
    });