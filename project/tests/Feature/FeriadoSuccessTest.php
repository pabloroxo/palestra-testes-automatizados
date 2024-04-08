<?php

namespace Tests\Feature;

use App\Models\Holiday;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FeriadoSuccessTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * List all holidays
     */
    public function testListAllHolidays(): void
    {
        //Given

        //When
        $response = $this->getJson(
            route('holidays.index'),
        );

        //Then
        $response->assertOk();
    }

    /**
     * Retrieve holiday
     */
    public function testRetrieveHoliday(): void
    {
        //Given
        $holiday = Holiday::factory()->create();

        //When
        $response = $this->getJson(
            route('holidays.show', $holiday->id),
        );

        //Then
        $response->assertOk();
        $this->assertEquals(
            $holiday->name,
            $response->getData()->name,
        );
    }

    /**
     * Create holiday
     */
    public function testCreateHoliday(): void
    {
        //Given
        $holiday = Holiday::factory()->make();

        //When
        $response = $this->postJson(
            route('holidays.store'),
            $holiday->toArray(),
        );

        //Then
        $response->assertCreated();
        $this->assertEquals(
            $holiday->name,
            $response->getData()->name,
        );
    }

    /**
     * Update holiday
     */
    public function testUpdateHoliday(): void
    {
        //Given
        $holiday = Holiday::factory()->create();
        $newName = fake()->name();

        //When
        $response = $this->putJson(
            route('holidays.update', $holiday->id),
            [
                'name' => $newName,
            ],
        );

        //Then
        $response->assertOk();
        $this->assertEquals(
            $newName,
            $response->getData()->name,
        );
    }

    /**
     * Delete holiday
     */
    public function testDeleteHoliday(): void
    {
        //Given
        $holiday = Holiday::factory()->create();

        //When
        $response = $this->deleteJson(
            route('holidays.destroy', $holiday->id),
        );

        //Then
        $response->assertNoContent();
    }
}
