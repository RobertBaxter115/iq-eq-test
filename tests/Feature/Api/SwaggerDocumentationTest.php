<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class SwaggerDocumentationTest extends TestCase
{
    public function test_swagger_documentation_is_accessible(): void
    {
        $response = $this->get('/api/documentation');

        $response->assertStatus(200);
    }
}
