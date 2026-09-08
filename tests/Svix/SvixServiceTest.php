<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Svix;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Svix\SvixService;
use OpenCompany\Integrations\Svix\SvixToolProvider;
use OpenCompany\Integrations\Svix\Tools\SvixCreateMessage;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Svix API coverage and request mapping.
 */
final class SvixServiceTest extends TestCase
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

    public function test_provider_exposes_official_svix_surface(): void
    {
        $provider = new SvixToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://api.svix.com', $provider->integrationMeta()['docs_url']);
        self::assertCount(128, $tools);
        self::assertArrayHasKey('svix_list_applications', $tools);
        self::assertArrayHasKey('svix_create_message', $tools);
        self::assertArrayHasKey('svix_create_stream', $tools);
        self::assertArrayHasKey('svix_create_ingest_source', $tools);
        self::assertArrayHasKey('svix_list_operational_webhook_endpoints', $tools);
        self::assertArrayNotHasKey('svix_get_current_user', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__.'/../../packages/svix/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->scriptDocsPath());
    }

    public function test_service_maps_path_query_headers_json_and_bearer_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new SvixService('svix-token', 'https://api.example.test');
        $service->call('svix_list_messages', [
            'app_id' => 'app_123',
            'limit' => 5,
            'with_content' => true,
        ]);
        $service->call('svix_create_message', [
            'app_id' => 'app_123',
            'idempotency_key' => 'message-123',
            'payload' => [
                'eventType' => 'user.created',
                'payload' => ['id' => 'user_123'],
            ],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.example.test/api/v1/app/app_123/msg?')
            && str_contains($request->url(), 'limit=5')
            && str_contains($request->url(), 'with_content=1')
            && $request->hasHeader('Authorization', 'Bearer svix-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v1/app/app_123/msg'
            && $request->hasHeader('Authorization', 'Bearer svix-token')
            && $request->hasHeader('idempotency-key', 'message-123')
            && $request['eventType'] === 'user.created'
            && $request['payload']['id'] === 'user_123');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new SvixCreateMessage(new SvixService('svix-token'));
        $result = $tool->execute(['payload' => ['eventType' => 'user.created']]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('app_id is required', (string) $result->error);
    }
}
