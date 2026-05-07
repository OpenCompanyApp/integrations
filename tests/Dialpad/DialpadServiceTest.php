<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Dialpad;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Dialpad\DialpadService;
use OpenCompany\Integrations\Dialpad\DialpadToolProvider;
use OpenCompany\Integrations\Dialpad\Tools\DialpadUsersGet;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Dialpad official API operation coverage.
 */
final class DialpadServiceTest extends TestCase
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

    public function test_provider_exposes_official_dialpad_surface(): void
    {
        $provider = new DialpadToolProvider;
        $tools = $provider->tools();
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertCount(193, $tools);
        self::assertArrayHasKey('dialpad_users_list', $tools);
        self::assertArrayHasKey('dialpad_sms_send', $tools);
        self::assertArrayHasKey('dialpad_company_get', $tools);
        self::assertArrayHasKey('dialpad_webhooks_create', $tools);
        self::assertArrayNotHasKey('dialpad_list_users', $tools);
        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], "\\") + 1);
            self::assertFileExists(__DIR__.'/../../packages/dialpad/src/Tools/'.$shortName.'.php');
        }
    }

    public function test_service_maps_path_query_body_and_auth_modes(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new DialpadService('token-123', 'https://api.example.test');
        $service->call('dialpad_users_list', ['state' => 'active', 'email' => 'user@example.test']);
        $service->call('dialpad_sms_send', ['body' => ['text' => 'hello', 'user_id' => '42']]);
        $queryAuth = new DialpadService('token-456', 'https://api.example.test', 'query');
        $queryAuth->call('dialpad_users_get', ['id' => 'user-1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/api/v2/users?state=active&email=user%40example.test'
            && $request->hasHeader('Authorization', 'Bearer token-123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v2/sms'
            && $request->data()['text'] === 'hello');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/api/v2/users/user-1?apikey=token-456');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new DialpadUsersGet(new DialpadService('token'));
        $result = $tool->execute([]);
        self::assertFalse($result->succeeded());
        self::assertStringContainsString('id is required', (string) $result->error);
    }
}