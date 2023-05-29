<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'Employee_Name'=>'Jeswin',
           'Email'=> 'jeswin@gmail.com',
           'Address'=> 'thrissur',
           'Date'=> '2023-05-09',
           'Status'=> false,
           'Phone' => 1234567890,
           'selectedGender'=>'male'
        ];
    }
}
