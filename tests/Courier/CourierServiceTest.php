<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Courier;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Courier\CourierService;
use OpenCompany\Integrations\Courier\CourierToolProvider;
use OpenCompany\Integrations\Courier\Tools\CourierProfilesGet;
use OpenCompany\Integrations\Courier\Tools\CourierSend;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Courier API coverage and request mapping.
 */
final class CourierServiceTest extends TestCase
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

    public function test_provider_exposes_official_courier_api_surface(): void
    {
        $provider = new CourierToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://www.courier.com/docs/reference/', $provider->integrationMeta()['docs_url']);
        self::assertCount(89, $tools);
        self::assertArrayHasKey('courier_send', $tools);
        self::assertArrayHasKey('courier_bulk_create_job', $tools);
        self::assertArrayHasKey('courier_profiles_create', $tools);
        self::assertArrayHasKey('courier_users_tokens_add_multiple', $tools);
        self::assertArrayHasKey('courier_notifications_publish', $tools);
        self::assertArrayHasKey('courier_messages_get_history', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__.'/../../packages/courier/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_query_path_json_and_bearer_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CourierService('courier-key', 'https://api.example.test');
        $service->call('courier_messages_list', [
            'cursor' => 'next-page',
            'message_id' => 'msg-123',
        ]);
        $service->call('courier_profiles_create', [
            'user_id' => 'user-123',
            'payload' => [
                'profile' => ['email' => 'ada@example.test'],
            ],
        ]);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.example.test/messages?')
                && ($query['cursor'] ?? null) === 'next-page'
                && ($query['messageId'] ?? null) === 'msg-123'
                && $request->hasHeader('Authorization', 'Bearer courier-key');
        });

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/profiles/user-123'
            && $request->hasHeader('Authorization', 'Bearer courier-key')
            && $request['profile']['email'] === 'ada@example.test');
    }

    public function test_tools_validate_required_payload_and_path_arguments(): void
    {
        $service = new CourierService('courier-key');

        $missingPayload = (new CourierSend($service))->execute([]);
        self::assertFalse($missingPayload->succeeded());
        self::assertStringContainsString('payload is required', (string) $missingPayload->error);

        $missingPath = (new CourierProfilesGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('user_id is required', (string) $missingPath->error);
    }
}
