<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Vbout;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Vbout\Tools\VboutCreateContact;
use OpenCompany\Integrations\Vbout\VboutService;
use OpenCompany\Integrations\Vbout\VboutToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for VBOUT's OpenAPI-backed operation surface.
 */
final class VboutServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        parent::tearDown();
    }

    public function test_operation_requests_use_documented_key_query_auth_and_original_parameters(): void
    {
        Http::fake(['*' => Http::response(['response' => ['data' => ['ok' => true]]], 200)]);

        $service = new VboutService('vbout-key', 'https://api.example.test/1');
        $service->executeOperation('email_marketing_add_contact', [
            'email' => 'person@example.test',
            'list_id' => 123,
            'status' => 'Active',
            'fields' => ['first' => 'Jane'],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && str_starts_with($request->url(), 'https://api.example.test/1/EmailMarketing/AddContact')
            && $request->data()['key'] === 'vbout-key'
            && $request->data()['listid'] === 123
            && $request->data()['status'] === 'Active');
    }

    public function test_tool_validates_required_parameters_before_calling_api(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $tool = new VboutCreateContact(new VboutService('vbout-key', 'https://api.example.test/1'));
        $result = $tool->execute(['email' => 'person@example.test']);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('list_id', (string) $result->error);
        Http::assertNothingSent();
    }

    public function test_provider_registers_official_openapi_catalog(): void
    {
        $provider = new VboutToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertCount(71, VboutService::operations());
        self::assertGreaterThanOrEqual(71, count($tools));
        self::assertArrayHasKey('vbout_get_current_user', $tools);
        self::assertArrayHasKey('vbout_create_contact', $tools);
        self::assertArrayHasKey('vbout_email_marketing_add_tag', $tools);
        self::assertArrayHasKey('vbout_social_media_add_post', $tools);
        self::assertArrayHasKey('vbout_webhook_add', $tools);
        self::assertArrayHasKey('vbout_aichatbot_copy', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new VboutService('vbout-key'));
            $names[] = $instance->name();
        }

        self::assertCount(count($names), array_unique($names));
    }
}
