<?php

namespace Database\Factories;

use App\Enums\DataProviderType;
use App\Enums\TransactionXStatus;
use App\Enums\TransactionYStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        [$status, $provider] = $this->getRandomProviderWithRandomStatus();

        return [
            'identification' => $this->faker->uuid,
            'status' => $status,
            'provider' => $provider,
            'currency' => $this->faker->currencyCode,
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'date' => $this->faker->dateTimeThisYear,
            'user_email' => User::factory()->create()->email,
        ];
    }

    public function getRandomProviderWithRandomStatus()
    {
        $provider = $this->faker->randomElement([...DataProviderType::getValues()]);

        return match ($provider) {
            DataProviderType::DataProviderX => [
                $this->faker->randomElement(TransactionXStatus::getValues()),
                $provider,
            ],
            DataProviderType::DataProviderY => [
                $this->faker->randomElement(TransactionYStatus::getValues()),
                $provider,
            ],
        };
    }
}
