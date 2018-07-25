<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Id extends Model
{
    protected $fillable = [
        'type',
        'school_id',
        'student_id_no',
        'card_id_no',
        'last_name',
        'first_name',
        'middle_name',
        'lrn',
        'year_level',
        'section',
        'is_new_student',
        'sex',
        'date_of_birth',
        'phone_number',
        'address',
        'address_two',
        'father_name',
        'mother_name',
        'guardian',
        'adviser',
        'id_status',
    ];

    protected $appends = [
        'full_name', 'id_layout', 'year_level_position'
    ];

    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function school()
   	{
   		return $this->belongsTo('App\School');
   	}

    public function getFullNameAttribute()
    {
        $last_name = $this->attributes['last_name'];
        $first_name = $this->attributes['first_name'];
        $middle_name = $this->attributes['middle_name'];

        if($middle_name) {
            $middle_name = explode(' ', $middle_name);

            $mid_name = '';
            foreach ($middle_name as $middle) {
                if(isset($middle[0])) {
                    $mid_name .= $middle[0];
                }
            }
            $middle_name = ($mid_name != '') ? $mid_name . '.' : '';
        }

        $full_name = $first_name  . ' ' . $middle_name . ' ' . $last_name;
        return ucwords($full_name);
    }

    public function getidLayoutAttribute() {
        $layout = 'SHS';

        switch ($this->attributes['year_level']) {
            case 'GRADE 1':
            case 'GRADE 2':
            case 'GRADE 3':
            case 'GRADE 4':
            case 'GRADE 5':
            case 'GRADE 6':
                $layout = 'GS';
                break;
            case 'GRADE 7':
            case 'GRADE 8':
            case 'GRADE 9':
            case 'GRADE 10':
                $layout = 'HS';
                break;
            default:
                $layout = 'SHS';
                break;
        }

        return $layout;
    }

    public function getYearLevelPositionAttribute() {
        $year_level_position = $this->attributes['year_level'];
        if($this->attributes['section']) {
            $year_level_position .= ' - ' . $this->attributes['section'];
        }
        return  $year_level_position;
    }
}
