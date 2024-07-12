<?php

// Підключення до бібліотеки Google API
require_once 'form/php_vendor/vendor/autoload.php';
use Google\Client as Google_Client;
use Google\Service\Drive as Google_Service_Drive;

// Параметри підключення до Google Диску
$client = new Google_Client();
$client->setAuthConfig('./musicsiteproject-a4a256ea7f3a.json');
$client->addScope(Google_Service_Drive::DRIVE);
$service = new Google_Service_Drive($client);

// Ідентифікатор папки, де зберігаються аудіофайли
$musicFolderId = '1yQPjn6m9-QPTINUiWr8X9FfPwJK-d4rN';

// Функція для отримання URL аудіофайлу з Google Drive
function getAudioFileUrlFromGoogleDrive($service, $folderId) {
    try {
        // Запит на список файлів у вказаній папці
        $response = $service->files->listFiles([
            'q' => "'$folderId' in parents"
        ]);

        // Отримання першого знайденого аудіофайлу
        foreach ($response->getFiles() as $file) {
            if (strpos($file->getMimeType(), 'audio') !== false) {
                return $file->getWebViewLink(); // Повертаємо URL аудіофайлу
            }
        }
    } catch (Google_Service_Exception $e) {
        // Обробка помилки
        error_log('Google Drive API Error: ' . $e->getMessage());
    } catch (Google_Exception $e) {
        // Обробка помилки
        error_log('Google Client Error: ' . $e->getMessage());
    }

    return null; // Якщо аудіофайл не знайдено, повертаємо null
}

// Отримання URL аудіофайлу з Google Drive
$url_to_audio_file_from_google_drive = getAudioFileUrlFromGoogleDrive($service, $musicFolderId);

// Перевірка наявності URL аудіофайлу
if ($url_to_audio_file_from_google_drive) {
    // Встановлення заголовків відповіді для відтворення аудіофайлу
    header("Content-Type: audio/mpeg");
    header("Content-Disposition: inline; filename=\"name.mp3\"");

    // Виведення контенту аудіофайлу на вихід
    echo file_get_contents($url_to_audio_file_from_google_drive);
} else {
    // Якщо аудіофайл не знайдено, виведемо повідомлення про помилку
    echo "Помилка: аудіофайл не знайдено на Google Drive.";
}

?>
