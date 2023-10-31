<?php

namespace App\Listeners\Sweepstake;

use App\Events\SweepstakeCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\GenerateQuotas as GenerateQuotasJob;

class GenerateQuotas
{
    public array $quotas;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->quotas = [];
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SweepstakeCreated  $event
     * @return void
     */
    public function handle(SweepstakeCreated $event)
    {
        for ($i = 1; $i <= 100000; $i++)
        {
            $paddedNumber = str_pad($i, 5, '0', STR_PAD_LEFT);

            $this->quotas[] = [
                'sweepstake_id' => $event->sweepstake->id,
                'number' => $paddedNumber
            ];
        }

        $this->quotas = collect($this->quotas)->chunk(10000)->toArray();

        $remaining_blocks = 1;

        foreach ($this->quotas as $block)
        {
            $event->sweepstake->update(['remaining_blocks' => $remaining_blocks++]);
            dispatch(new GenerateQuotasJob($block, $event->sweepstake));
        }
    }
}
