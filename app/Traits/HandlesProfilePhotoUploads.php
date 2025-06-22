<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesProfilePhotoUploads
{
    public function updateProfilePhoto(UploadedFile $photo, $storagePath = 'profile-photos'): \Illuminate\Http\RedirectResponse
    {
        tap($this->profile_photo_path, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'profile_photo_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->profilePhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->profilePhotoDisk())->delete($previous);
            }
        });

        return redirect()->route('admin.settings.account.settings');
    }
}
