<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Modules\Transaction\Trip\Contracts\TripQueueNotificationInterface;

class SendBookingNotificationToDriver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'driver:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push booking info from rider to driver';

    protected $tripQueueNotif;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TripQueueNotificationInterface $tripQueueNotif)
    {
        parent::__construct();
        $this->tripQueueNotif = $tripQueueNotif;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        print_r($this->tripQueueNotif->getListAndSend());exit;
    }
}
