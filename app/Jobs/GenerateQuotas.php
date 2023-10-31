<?php

namespace App\Jobs;

use App\Models\Enums\SweepstakeStatus;
use App\Models\Quota;
use App\Models\Sweepstake;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateQuotas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $quotas;
    public Sweepstake $sweepstake;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $block, Sweepstake $sweepstake)
    {
        $this->quotas = $block;
        $this->sweepstake = $sweepstake;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Quota::insert($this->quotas);

        $this->sweepstake->remaining_blocks = $this->sweepstake->remaining_blocks - 1;
        $this->sweepstake->status = $this->sweepstake->remaining_blocks == 0 ? SweepstakeStatus::AVAILABLE : SweepstakeStatus::DRAFT;
        $this->sweepstake->save();
    }
}
