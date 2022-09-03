<?php

class File
{
    public static function upload($data, $tmp, $nameUniqid = false, $size = 1000000, $type = ['jpg', 'jpeg', 'png'])
    {
        $nameFile = $_FILES[$data]['name'];
        $sizeFile = $_FILES[$data]['size'];
        $tmpName = $_FILES[$data]['tmp_name'];

        $extensionImageValid = $type;
        $extensionImage = explode('.', $nameFile);
        $extensionImage = strtolower(end($extensionImage));

        if (!in_array($extensionImage, $extensionImageValid)) {
            echo '<script>alert("What you uploaded is not an image!");</script>';
        }

        if ($sizeFile > $size) {
            echo '<script>alert("Image size is too big!");</script>';
        }

        if ($nameUniqid == true) {
            $nameFileNew = uniqid() . '.' . $extensionImage;
            $file = $nameFileNew;
        } else {
            $file = $nameFile;
        }

        move_uploaded_file($tmpName, $tmp . $file);

        return $file;
    }

    public function rename($tmp, $target, $rename, $extension = false)
    {
        if (substr($tmp, strlen($tmp) - 1) == '/') {
            $folder = $tmp;
        } else {
            $folder = $tmp . '/';
        }

        if ($extension == false) {
            $array = explode(".", $target);
            $extensionFile = $array[1];
        } else {
            $extensionFile = $extension;
        }

        if (!file_exists($folder . $rename . '.' . $extensionFile)) {
            if (file_exists($folder . $target)) {
                rename($folder . $target, $rename . $extensionFile);
            }
        }
    }

    public function create($tmp, $file, $content)
    {
        if (substr($tmp, strlen($tmp) - 1) == '/') {
            $folder = $tmp;
        } else {
            $folder = $tmp . '/';
        }

        if (!file_exists($folder, $file)) {
            $fp = fopen($folder . $file, "w");
            fwrite($fp, $content);
            fclose($fp);
        } else {
            echo '<script>alert("File ' . $file . ' failed to add!");</script>';
        }
    }

    public static function delete($tmp, $file)
    {
        if (substr($tmp, strlen($tmp) - 1) == '/') {
            $folder = $tmp;
        } else {
            $folder = $tmp . '/';
        }

        if (!file_exists($folder, $file)) {
            if (unlink($file)) {
            } else {
                echo '<script>alert("File ' . $file . ' failed to delete!");</script>';
            }
        } else {
            echo '<script>alert("File ' . $file . ' not found!");</script>';
        }
    }
}
