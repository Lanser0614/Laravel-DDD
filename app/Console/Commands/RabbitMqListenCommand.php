<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Rabbit\RabbitQueue;
use Illuminate\Console\Command;
use Modules\BaseModule\EventBus\Contract\EventBus;

class RabbitMqListenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit-mq:listen-credit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for consume credit strem queue';

    /**
     * Execute the console command.
     */
   public function handle(EventBus $eventBus): void
   {
        $eventBus->consume(RabbitQueue::CREDIT_QUEUE, 'credit-service');
    }
}
