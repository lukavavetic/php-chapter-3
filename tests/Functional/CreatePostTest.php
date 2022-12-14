<?php

declare(strict_types=1);

namespace Tests\Functional;

/** @group Functional */
class CreatePostTest extends FunctionalTestCase
{
    public function testCreatePost(): void
    {
        // Arrange
        $requestBody = [
            'title' => 'Title',
            'description' => 'Description',
            'userId' => 1,
        ];

        $expectedResponse = [
            'title' => 'Title',
            'description' => 'Description',
        ];

        // Act
        $response = $this->post($requestBody);

        // Assert
        $this->assertSame($expectedResponse, $response);
    }
}