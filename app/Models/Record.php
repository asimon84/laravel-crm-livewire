<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'string',
        'text',
        'json',
        'boolean',
        'integer',
        'float',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'string' => 'string',
            'text' => 'string',
            'json' => 'string',
            'boolean' => 'boolean',
            'integer' => 'integer',
            'float' => 'float',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Return formatted array for c3 charts, count of all records within the last 'x' days.
     *
     * @param int $days
     *
     * @return array
     */
    public static function getRecordsLastXDays(int $days = 7): array
    {
        $startDate = Carbon::now()->subDays($days)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $dateRange = [];
        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
            $dateRange[$date] = 0;
        }

        $dailyCounts = Record::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->keyBy('date')
            ->toArray();

        $finalCounts = array_replace($dateRange, array_column($dailyCounts, 'count', 'date'));

        $dates = array_keys($finalCounts);
        array_unshift($dates, "dates");

        $records = array_values($finalCounts);
        array_unshift($records, "records");

        return [$dates, $records];
    }
}
