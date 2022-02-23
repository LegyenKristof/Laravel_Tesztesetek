<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candy extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cocoa_content', 'sugar_content'];

    public static function csokisakCukortartalmaAtlag() {
        $avg = Candy::where('cocoa_content', '>', 0)->avg('sugar_content');
        if($avg == null)
            return NAN;
        return $avg;
    }

    public static function cukormentesCsokimentesMennyi() {
        $count = Candy::where([['cocoa_content', '=', 0],['sugar_content', '=', 0]])->count();
        return $count;
    }

    public static function cukrosakLegkissebbCukor() {
        $min = Candy::where('sugar_content', '>', 0)->min('sugar_content');
        if($min == null)
            return NAN;
        return $min;
    }
}
