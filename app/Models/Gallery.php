<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'galleries';
    protected $fillable = [
        'image_name',
        'image_extention',
        'image_size',
        'url',
        'file_type'
    ];
    protected $dates = ['deleted_at'];

    public static function fileExtention($hasFile, $file)
    {
        if ($hasFile) {
            return $file->getClientOriginalExtension();
        } else {
            return null;
        }
    }
    public static function fileSize($hasFile, $file)
    {
        if ($hasFile) {
            $fileSize = $file->getSize();
            $size = round($fileSize / 1024, 2);
            if ($size >= 1024.00) {
                $sizeInMB = $size / 1024; // Convert kilobytes to megabytes
                $sizeInMBRounded = (int) $sizeInMB; // Get the integer part
                $sizeInMBFraction = (int) (($sizeInMB - $sizeInMBRounded) * 100); // Get the fractional part
                return $sizeInMBRounded . "." . str_pad($sizeInMBFraction, 2, "0", STR_PAD_LEFT) . "MB"; // Format to two decimal places
                // return round($size / 1024, 2);
                // return round($size / 1024, 2) . "MB"; // Further convert KB to MB
            } else {
                // $sizeInKBRounded = (int) $size; // Get the integer part
                // $sizeInKBFraction = (int) (($size - $sizeInKBRounded) * 100); // Get the fractional part
                // return $sizeInKBRounded . "." . str_pad($sizeInKBFraction, 2, "0", STR_PAD_LEFT) . "KB"; // Format to two decimal places
                return $size . "KB";
            }
        } else {
            return null;
        }
    }
    public static function fileStore($hasFile, $file, $requestFileName, $galleryFile)
    {
        if ($hasFile) {
            $name = $requestFileName;
            $fileExtension = $file->getClientOriginalExtension();
            $filename = $name . "." . $fileExtension;
            $file->move('upload/images/galleries/', $filename);
            // $file->move(storage_path('/app/public/galleries'), $filename);
            // Storage::put('avatars/' . $filename, file_get_contents($file));
            $path = url('/') . '/upload/images/galleries/' . $filename;
            return $path;
        } else {
            return null;
        }
    }
    public static function fileUpdate($requestFileName, $galleryFile)
    {
        if ($requestFileName !== $galleryFile) {
            $directory = '/upload/images/galleries/';
            $fileName = basename($galleryFile);
            $originalFilePath = public_path($directory . $fileName);
            if ($originalFilePath) {
                $newName = $requestFileName;
                $extension = pathinfo($originalFilePath, PATHINFO_EXTENSION); // Get the file extension
                $newFilename = Str::slug($newName) . '.' . $extension; // Create new filename
                $newFilePath = public_path($directory . $newFilename); // Full path to the new file
                rename($originalFilePath, $newFilePath);
                $path = url('/') . $directory . $newFilename;
                return $path;
            }
        } else {
            return $galleryFile;
        }
    }

    public static function fileType($hasFile, $file)
    {
        if ($hasFile) {
            return $file->getClientMimeType();
        } else {
            return null;
        }
    }
    public static function Download($galleryImage)
    {
        $fileName = basename($galleryImage);
        $file_path = public_path() . "/upload/images/galleries/" . $fileName;
        if (!file_exists($file_path)) {
            abort(404);
        }

        $file = file_get_contents($file_path);
        return (new Response($file, 200))
            ->header('Content-Type', 'application/octet-stream');
        // ->header('Content-Type', 'image/jpeg');
    }

}
