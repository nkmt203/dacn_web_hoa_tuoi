<?php
function uploadImage($fileInput, $tagetDir = __DIR__ . "/../uploads/")
{
    if (isset($fileInput) && $fileInput['error'] == 0) {
        if (!is_dir($tagetDir)) {
            mkdir($tagetDir, 0777, true);
        }
        $fileName = time() . '_' . basename($fileInput['name']);
        $targetFile = $tagetDir . $fileName;

        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $fileAlow = ['jpg', 'png', 'jpeg'];

        if (in_array($fileType, $fileAlow)) {
            if (move_uploaded_file($fileInput['tmp_name'], $targetFile)) {
                return $fileName;
            }
        }
    }
    return null;
}

function deleteImage($fileName, $tagetDir = __DIR__ . '/../uploads/')
{
    if (!empty($fileName)) {
        $filePath = $tagetDir . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }
    }
    return false;
}
