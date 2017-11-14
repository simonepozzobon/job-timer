<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function priority()
    {
        return $this->belongsTo('App\Priority');
    }

    public function timers()
    {
        return $this->hasMany('App\Timer');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function verify_category()
    {
        $project = Project::find($this->project_id);
        $categories = $project->categories()->count();

        if ($categories > 0) {
          if ($this->category_id == null) {
            $this->category_id == $project->categories()->first()->id;
            $this->save();
          }
          return true;
        } else {
          return false;
        }
    }

    public function set_time()
    {
      $dt = new Carbon($this->created_at);
      $this->time = $dt->diffForHumans();

      // Verifica se ha un timer attivo
      $timer = [
        'status' => $this->has_active_timer(),
        'time' => $this->calculate_timer()
      ];
      $this->timer = $timer;

      return $this;
    }

    public function has_active_timer()
    {
        $timer = $this->timers()->where('active', '=', 1)->first();

        // Verifica se ha un timer attivo
        if ($timer != null) {
          // ha un timer attivo
          return $timer;
        } else {
          // non ha nessun timer attivo
          return false;
        }
    }

    public function calculate_timer()
    {
        // verifico se ha un timer attivo
        $active_timer = $this->has_active_timer();
        // recupero tutti i timers
        $timers = $this->timers()->get();

        // inizializzo la variabile time
        $time = 0;

        // verifico se ci sono timer e timer attivi
        if ($active_timer || $timers->count()) {

          // se c'è un timer attivo
          if ($active_timer || $timers->count() > 1) {

            // c'è più di un timer
            foreach ($timers as $key => $timer) {

              // se è il timer attivo, calcolo il tempo fino ad ora
              if ($timer->active == 1) {
                $start_time = new Carbon($timer->created_at);
                $finish_time = Carbon::now();
                $difference_in_seconds = $finish_time->diffInSeconds($start_time);
              } else {
                // altrimenti mi limito a convertire il campo time in secondi
                $difference_in_seconds = strtotime("1970-01-01 $timer->time UTC");
              }

              $time = $time + $difference_in_seconds;

            }

            // Converto i secondi in H:i:s
            $time = gmdate('H:i:s', $time);
            return $time;

          } else {
            // c'è solo un timer

            // se è il timer attivo, calcolo il tempo fino ad ora
            if ($active_timer) {
              $start_time = new Carbon($timers->first()->created_at);
              $finish_time = Carbon::now();
              $difference_in_seconds = $finish_time->diffInSeconds($start_time);
            } else {
              // altrimenti mi limito a convertire il campo time in secondi
              $difference_in_seconds = strtotime('1970-01-01 '.$timers->first()->time.' UTC');
            }

            // Converto i secondi in H:i:s
            $time = gmdate('H:i:s', $difference_in_seconds);
            return $time;
          }

        } else {
          // non ci sono timers
          return false;
        }
    }
}
