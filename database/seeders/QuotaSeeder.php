<?php

namespace Database\Seeders;

use App\Models\Enums\SweepstakeStatus;
use App\Models\Quota;
use App\Models\Sweepstake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Sweepstake::factory()->create();

        $sweepstakes = Sweepstake::all();

        foreach ($sweepstakes as $sweepstake)
        {
            $quotas = [];

            for ($i = 1; $i <= 100000; $i++)
            {
                $paddedNumber = str_pad($i, 5, '0', STR_PAD_LEFT);

                $quotas[] = [
                    'sweepstake_id' => $sweepstake->id,
                    'number' => $paddedNumber
                ];
            }

            $quotas = collect($quotas)->chunk(10000)->toArray();

            foreach ($quotas as $block)
            {
                Quota::insert($block);
            }

            $sweepstake->update(['status' => SweepstakeStatus::AVAILABLE]);
        }
    }
}
