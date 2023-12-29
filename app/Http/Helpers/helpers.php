<?php

function uploadImage($file, $path, $oldImage = null)
{
    $get_name_image = $file->getClientOriginalName();
    $name_image = current(explode('.', $get_name_image));
    $new_image = $name_image . rand(0, 99) . '.' . $file->getClientOriginalExtension();
    $file->move($path, $new_image);

    if ($oldImage != null) {
        unlink($path . $oldImage);
    }

    return $new_image;
}

