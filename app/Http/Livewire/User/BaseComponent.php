<?php

namespace App\Http\Livewire\User;

use Carbon\Carbon;
use Livewire\Component;

class BaseComponent extends Component
{
    public function regex_url($text, $type = 'youtube')
    {
        if ($type == 'youtube') {
            $pattern = '#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#';

            if (preg_match($pattern, $text, $matches)) {
                return $matches[0];
            } else {
                return false;
            }
        } elseif ($type == 'drivePDF') {
            $pattern = '/(file\/d\/)(.*)(\/)/';
            if (preg_match($pattern, $text, $matches)) {
                return $matches[0];
            } else {
                return false;
            }
        } elseif ($type == 'urls') {
            $pattern = '~[a-z]+://\S+~';
            $replacement = '<a href="${0}" target="_blank">${0}</a>';
            return preg_replace($pattern, $replacement, $text);
        } else {
            return false;
        }
    }

    public function image_user($gender, $cover): string
    {
        $img = $gender == 2 ? 'woman.svg' : 'man.svg';
        return $cover ? $cover : $img;
    }

    public function timeElapsedString($datetime): string
    {
        return Carbon::parse($datetime)->diffForHumans();
    }
}
