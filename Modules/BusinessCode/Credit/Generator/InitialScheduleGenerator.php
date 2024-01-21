<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\Generator;

use Modules\BaseModule\BaseUtils\SimpleUuid;
use Modules\BusinessCode\Credit\ValueObject\Schedule\InitialSchedule;
use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Data;

class InitialScheduleGenerator extends Data
{
    public function __construct(
        #[IntegerType]
        private readonly int   $totalAmount,
        #[IntegerType]
        private readonly int   $duration,
        #[IntegerType]
        private readonly int   $clientCommission,
        #[Nullable]
        private readonly ?array $payments
    )
    {
    }

    private function generateInitialSchedule(): array {
        // Define loan parameters
        $creditAmount = $this->totalAmount;
        $durationMonths = $this->duration;
        $interestRate = $this->clientCommission / $this->duration;

        // Calculate monthly payment using the annuity formula
        $monthlyPayment = $creditAmount * ($interestRate / (1 - pow(1 + $interestRate, -$durationMonths)));

        $initialScheduleArray = [];
        // Create an array to store the payment schedule
        /** @var ArrayType $paymentSchedule */
        $paymentSchedule = [];

        // Generate payment details for each month
        for ($month = 1; $month <= $durationMonths; $month++) {
            $interest = $creditAmount * $interestRate;  // Calculate monthly interest
            $principal = $monthlyPayment - $interest;   // Calculate principal payment
            $remainingBalance = $creditAmount - ($month - 1) * $principal;  // Update remaining balance

            // Store payment details in the schedule array
            $paymentSchedule[$month] = [
                'uuid' => SimpleUuid::random()->value(),
                'date' => now()->addMonth($month),
                'payment_date' => now()->addMonth($month),
                'base_amount' => $monthlyPayment,
                'amount' => $monthlyPayment,
                'is_paid' => false,
                'balance_after' => $remainingBalance
            ];

            $initialScheduleArray[] =  InitialSchedule::fromArray($paymentSchedule[$month]);
        }

        return $initialScheduleArray;
    }

    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getClientCommission(): int
    {
        return $this->clientCommission;
    }

    public function getPayments(): array
    {
        return $this->payments;
    }
}
