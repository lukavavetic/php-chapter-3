<?php

namespace Tests\Functional;

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