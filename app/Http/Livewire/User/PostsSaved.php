<?php

namespace App\Http\Livewire\User;

use Carbon\Carbon;
use Livewire\Component;

class PostsSaved extends Component
{
    public function render()
    {
        $data['_title'] = 'Guardados';

        $this->emit('refreshContent');

        return view('livewire.user.posts-saved', $data)->layout('layouts.user');
    }

    public function birthdate_diff($dateto, $birthdate = false, $using_timestamps = false)
    {
        $datefrom = Carbon::now();

        if ($birthdate) {
            if (($m = Carbon::parse($dateto)->format('m-d')) < Carbon::parse($datefrom)->format('m-d')) {
                $y = (int)Carbon::parse($datefrom)->format('Y') + 1;
                $dateto = $y . '-' . $m;
            } else {
                $y = (int)Carbon::parse($datefrom)->format('Y');
                $dateto = $y . '-' . $m;
            }
        }

        if (!$using_timestamps) {
            $datefrom = strtotime($datefrom, 0);
            $dateto = strtotime($dateto, 0);
        }

        if (($data = $this->interval('m', $dateto, $datefrom)) > 0) {
            $m = $data > 1 ? $data . ' meses' : $data . ' mes';
            return 'Dentro de ' . $m;
        } elseif (($data = $this->interval('w', $dateto, $datefrom)) > 0) {
            $w = $data > 1 ? $data . ' semanas' : $data . ' semana';
            return 'Dentro de ' . $w;
        } elseif ($data = $this->interval('d', $dateto, $datefrom)) {
            $d = $data > 1 ? $data . ' dias' : $data . ' dia';
            return 'Dentro de ' . $d;
        } else {
            return '¡Hoy día!';
        }
    }

    private function interval($interval, $dateto, $datefrom)
    {
        $difference = $dateto - $datefrom; // Difference in seconds
        $months_difference = 0;

        switch ($interval) {

            case "m": // Number of full months
                $months_difference = floor($difference / 2678400);

                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }

                $months_difference--;

                $datediff = $months_difference;
                break;

            case "d": // Number of full days
                $datediff = floor($difference / 86400) + 1;
                break;

            case "w": // Number of full weeks
                $datediff = floor($difference / 604800);
                break;
        }

        return $datediff;
    }
}
