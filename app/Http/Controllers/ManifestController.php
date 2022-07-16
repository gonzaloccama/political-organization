<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Http\Request;
use URL;

class ManifestController extends Controller
{
    public function index()
    {
        $setting = SystemSetting::find(1);
        $data = [
            "name" => $setting->name . ' ' . $setting->campus,
            "short_name" => $setting->name . ' ' . $setting->campus,
            "start_url" => env('APP_URL'),
            "display" => "standalone",
            "theme_color" => "#1D477A",
            "background_color" => "#ffffff",
            "orientation" => "any",
            "status_bar" => "#1D477A",
            "splash" => [
                "640x1136" => "/images/icons/splash-640x1136.png",
                "750x1334" => "/images/icons/splash-750x1334.png",
                "828x1792" => "/images/icons/splash-828x1792.png",
                "1125x2436" => "/images/icons/splash-1125x2436.png",
                "1242x2208" => "/images/icons/splash-1242x2208.png",
                "1242x2688" => "/images/icons/splash-1242x2688.png",
                "1536x2048" => "/images/icons/splash-1536x2048.png",
                "1668x2224" => "/images/icons/splash-1668x2224.png",
                "1668x2388" => "/images/icons/splash-1668x2388.png",
                "2048x2732" => "/images/icons/splash-2048x2732.png"
            ],
            "icons" => [
                [
                    "src" => "/images/icons/icon-72x72.png",
                    "type" => "image/png",
                    "sizes" => "72x72",
                    "purpose" => "any"
                ],
                [
                    "src" => "/images/icons/icon-96x96.png",
                    "type" => "image/png",
                    "sizes" => "96x96",
                    "purpose" => "any"
                ],
                [
                    "src" => "/images/icons/icon-128x128.png",
                    "type" => "image/png",
                    "sizes" => "128x128",
                    "purpose" => "any"
                ],
                [
                    "src" => "/images/icons/icon-144x144.png",
                    "type" => "image/png",
                    "sizes" => "144x144",
                    "purpose" => "any"
                ],
                [
                    "src" => "/images/icons/icon-152x152.png",
                    "type" => "image/png",
                    "sizes" => "152x152",
                    "purpose" => "any"
                ],
                [
                    "src" => "/images/icons/icon-192x192.png",
                    "type" => "image/png",
                    "sizes" => "192x192",
                    "purpose" => "any"
                ],
                [
                    "src" => "/images/icons/icon-384x384.png",
                    "type" => "image/png",
                    "sizes" => "384x384",
                    "purpose" => "any"
                ],
                [
                    "src" => "/images/icons/icon-512x512.png",
                    "type" => "image/png",
                    "sizes" => "512x512",
                    "purpose" => "any"
                ]
            ],
            "description" => "ERP para gestion de recursos y actividades"
        ];


        header('Content-type: Application/json');
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        file_put_contents(public_path() . "/manifest.json", $json);
    }
}
