<?php

namespace Tests\Feature;

use App\Models\Holiday;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FeriadoErrorTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Retrieve non-existent holiday
     */
    public function testRetrieveNonExistentHoliday(): void
    {
        //Given
        $id = fake()->randomNumber();

        //When
        $response = $this->getJson(
            route('holidays.show', $id),
        );

        //Then
        $response->assertNotFound();
    }

    /**
     * Create invalid holiday (no name)
     */
    public function testCreateInvalidHolidayNoName(): void
    {
        //Given
        $holiday = Holiday::factory()->make();
        unset($holiday->name);
        
        //When
        $response = $this->postJson(
            route('holidays.store'),
            $holiday->toArray(),
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Create invalid holiday (empty name)
     */
    public function testCreateInvalidHolidayEmptyName(): void
    {
        //Given
        $holiday = Holiday::factory()->make();
        $holiday->name = '';

        //When
        $response = $this->postJson(
            route('holidays.store'),
            $holiday->toArray(),
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Create invalid holiday (long name)
     */
    public function testCreateInvalidHolidayLongName(): void
    {
        //Given
        $holiday = Holiday::factory()->make();
        $holiday->name = str_repeat('a', 31);

        //When
        $response = $this->postJson(
            route('holidays.store'),
            $holiday->toArray(),
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Create invalid holiday (no date)
     */
    public function testCreateInvalidHolidayNoDate(): void
    {
        //Given
        $holiday = Holiday::factory()->make();
        unset($holiday->date);
        
        //When
        $response = $this->postJson(
            route('holidays.store'),
            $holiday->toArray(),
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Create invalid holiday (empty date)
     */
    public function testCreateInvalidHolidayEmptyDate(): void
    {
        //Given
        $holiday = Holiday::factory()->make();
        $holiday->name = '';

        //When
        $response = $this->postJson(
            route('holidays.store'),
            $holiday->toArray(),
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Create invalid holiday (incorrect date format)
     */
    public function testCreateInvalidHolidayIncorrectDateFormat(): void
    {
        //Given
        $holiday = Holiday::factory()->make();
        $holiday->date = '04/07/1988';

        //When
        $response = $this->postJson(
            route('holidays.store'),
            $holiday->toArray(),
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Create invalid holiday (invalid date)
     */
    public function testCreateInvalidHolidayInvalidDate(): void
    {
        //Given
        $holiday = Holiday::factory()->make();
        $holiday->date = '9999-99-99';

        //When
        $response = $this->postJson(
            route('holidays.store'),
            $holiday->toArray(),
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Update non-existent holiday
     */
    public function testUpdateNonExistentHoliday(): void
    {
        //Given
        $id = fake()->randomNumber();

        //When
        $response = $this->putJson(
            route('holidays.update', $id),
            [],
        );

        //Then
        $response->assertNotFound();
    }

    /**
     * Update invalid holiday (empty name)
     */
    public function testUpdateInvalidHolidayEmptyName(): void
    {
        //Given
        $holiday = Holiday::factory()->create();
        $newName = '';

        //When
        $response = $this->putJson(
            route('holidays.update', $holiday->id),
            [
                'name' => $newName,
            ],
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Update invalid holiday (long name)
     */
    public function testUpdateInvalidHolidayLongName(): void
    {
        //Given
        $holiday = Holiday::factory()->create();
        $newName = str_repeat('a', 31);

        //When
        $response = $this->putJson(
            route('holidays.update', $holiday->id),
            [
                'name' => $newName,
            ],
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Update invalid holiday (incorrect date format)
     */
    public function testUpdateInvalidHolidayIncorrectDateFormat(): void
    {
        //Given
        $holiday = Holiday::factory()->create();
        $newDate = '04/07/1988';

        //When
        $response = $this->putJson(
            route('holidays.update', $holiday->id),
            [
                'date' => $newDate,
            ],
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Update invalid holiday (invalid date)
     */
    public function testUpdateInvalidHolidayInvalidDate(): void
    {
        //Given
        $holiday = Holiday::factory()->create();
        $newDate = '9999-99-99';

        //When
        $response = $this->putJson(
            route('holidays.update', $holiday->id),
            [
                'date' => $newDate,
            ],
        );

        //Then
        $response->assertUnprocessable();
    }

    /**
     * Delete non-existent holiday
     */
    public function testDeleteNonExistentHoliday(): void
    {
        //Given
        $id = fake()->randomNumber();

        //When
        $response = $this->deleteJson(
            route('holidays.destroy', $id),
        );

        //Then
        $response->assertNotFound();
    }
}
