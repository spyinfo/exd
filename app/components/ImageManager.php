<?php

namespace App\components;

use Intervention\Image\ImageManagerStatic as Image;

class ImageManager
{
    /**
     * @var string папка для документов
     */
    private $folder;

    /**
     * ImageManager constructor.
     */
    public function __construct()
    {
        $this->folder = config("uploadsFolder");
    }


    /**
     * Загружает картинку и возвращает путь к этой картинке
     *
     * @param $image
     * @param null $currentImage
     * @return string|null
     */
    public function uploadImg($image, $currentImage = null)
    {
        if(!is_file($image['tmp_name']) && !is_uploaded_file($image['tmp_name'])) { return $currentImage; }

        $this->deleteImage($currentImage);

        $fileName = generateRandomString() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);

        $image = Image::make($image['tmp_name']);
        $image->save($this->folder . $fileName);

        return $fileName;
    }



    /**
     * Проверяет существует ли картинка
     *
     * @param $path путь к картинке
     * @return bool существует или не существует
     */
    public function checkImageExists($path)
    {
        $isExists = false;

        if ($path != null && is_file($this->folder . $path) && file_exists($this->folder . $path))
        {
            $isExists = true;
        }
        return $isExists;
    }



    /**
     * Удаляет картинку из папки
     *
     * @param $image
     */
    public function deleteImage($image)
    {
        if ($this->checkImageExists($image))
        {
            unlink($this->folder . $image);
        }
    }



    /**
     * Возвращает размерность картинки
     *
     * @param $file картинка
     * @return string
     */
    public function getDimensions($file)
    {
        if ($this->checkImageExists($file))
        {
            list($width, $height) = getimagesize($this->folder . $file);
            return $width . "x" . $height;
        }
    }



    /**
     * Возращает путь к картинке
     *
     * @param $image
     * @return string
     */
    public function getImage($image)
    {
        $path = '';

        if ($this->checkImageExists($image))
        {
            $path = '/' . $this->folder . $image;
        }

        return $path;
    }
}