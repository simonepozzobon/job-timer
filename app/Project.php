<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function all_todos()
    {
        return $this->hasMany('App\Todo')->orderBy('order');
    }

    public function todos()
    {
        return $this->hasMany('App\Todo')->where('archived', '=', 0)->orderBy('order');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function archived_todos()
    {
        return $this->hasMany('App\Todo')->where('archived', '=', 1)->orderBy('order');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function stats()
    {
        // prendo tutti i todo
        $todos = $this->all_todos()->get();


        // calcolo data di inizio progetto e giorni dall'inizio
        Carbon::setLocale('it');
        $dt = new Carbon($this->created_at);
        $now = Carbon::now();
        $project_start = $dt->day.'/'.$dt->month.'/'.$dt->year;
        $days_from_start = $dt->diffInDays($now);


        // calcolo il tempo di lavoro totale
        $todos_time = 0;
        foreach ($todos as $key => $todo) {
          if ($todo->has_timer()) {
            $time = $todo->calculate_timer();
            $time_in_seconds = strtotime("1970-01-01 $time UTC");
            $todos_time = $todos_time + $time_in_seconds;
          }
        }
        $global_time = gmdate('H:i:s', $todos_time);


        // Todo completati
        $completed = $todos->filter(function($todo, $key) {
            return $todo->status_id == 2;
        });


        // Todo attivi
        $actives = $todos->filter(function($todo, $key) {
            return $todo->status_id != 2;
        });


        // Calcolo il tempo medio di completamento
        $completed_count = $completed->count();
        $actives_count = $actives->count();
        if ($completed_count > 0) {
          $average_time_in_seconds = $todos_time / $completed_count;
          $average_time = gmdate('H:i:s', $average_time_in_seconds);

          if ($actives_count > 0) {
            $time_to_complete_in_seconds = $average_time_in_seconds * $actives_count;
            $time_to_complete = gmdate('H:i:s', $time_to_complete_in_seconds);

            $dtc = $now->addSeconds($time_to_complete_in_seconds);
            $date_to_complete = $dtc->day.'/'.$dtc->month.'/'.$dtc->year.' - '.gmdate('H:i:s', $dtc->timestamp);
          } else {
            $time_to_complete = 'Non calcolabile';
            $date_to_complete = 'Non calcolabile';
          }

        } else {
          $average_time = 'Non calcolabile';
          $time_to_complete = 'Non calcolabile';
          $date_to_complete = 'Non calcolabile';
        }

        return $this->stats = [
          // project_start
          [
            'title' => 'Data Inizio Progetto:',
            'value' => $project_start,
          ],
          // days_from_start
          [
            'title' => 'Giorni dall\'inizio:',
            'value' => $days_from_start,
          ],
          // global_time
          [
            'title' => 'Lavoro Effettivo:',
            'value' => $global_time,
          ],
          // actives
          [
            'title' => 'Task Attivi:',
            'value' => $actives->count(),
          ],
          // completed
          [
            'title' => 'Task Completati:',
            'value' => $completed->count(),
          ],
          // total
          [
            'title' => 'Task Totali:',
            'value' => $todos->count(),
          ],
          // average_time
          [
            'title' => 'Tempo Medio Task Completo:',
            'value' => $average_time,
          ],
          // time_to_complete
          [
            'title' => 'Tempo al Completamento (stima):',
            'value' => $time_to_complete,
          ],
          // date_to_complete
          [
            'title' => 'Data del Completamento (stima):',
            'value' => $date_to_complete
          ],
        ];
    }
}
