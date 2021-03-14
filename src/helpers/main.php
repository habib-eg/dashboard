<?php


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\UploadedFile;

/**
 * @return string
 */
if (!function_exists('fileNameGenerator')) {

    function fileNameGenerator(): string
    {
        return uniqid(preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(config('app.name'))) . '_', false) . date('d_m_Y_H_i_s');
    }
}

if (!function_exists('uploader')) {
    /**
     * @param $file
     * @param string $folder
     * @param array $validation
     * @return mixed
     */
    function uploader($file, string $folder = "", array $validation = []): string
    {
        $request = request();
        $isFile = $file instanceof \Illuminate\Http\UploadedFile;
        // remove any / char form var
        $path = rtrim($folder, '/');
        // validate Image
        if (!$isFile) {
            if (empty($validation)) $request->validate([$file => ['required', 'image', 'mimes:jpeg,jpg,png']]);
            else $request->validate([$file => $validation]);
        }

        $image = $isFile ? $file : $request->file($file);
        $filename = fileNameGenerator() . '.' . $image->getClientOriginalExtension();
        $image->storeAs($path, $filename);
        return str_replace('//', '/', 'uploads/' . $path . '/' . $filename);
    }
}

if (!function_exists('adminGuard')) {
    /**
     * @param string $guard
     * @return Guard|StatefulGuard
     */
    function adminGuard(string $guard = null)
    {
        return auth()->guard($guard ?? config('dashboard.guard_name','admin'));
    }
}
