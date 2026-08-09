<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\UptimeRobot;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsCreate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsGet;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsList;
use OpenCompany\Integrations\UptimeRobot\UptimeRobotService;
use OpenCompany\Integrations\UptimeRobot\UptimeRobotToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated UptimeRobot v3 OpenAPI integration.
 */
final class UptimeRobotServiceTest extends TestCase
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

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new UptimeRobotToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/uptimerobot/uptimerobot-openapi-manifest.json'), true);

        self::assertSame(54, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('UptimeRobot', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('uptimerobot_monitors_list', array_keys($provider->tools()));
        self::assertContains('uptimerobot_incidents_list', array_keys($provider->tools()));
        self::assertContains('uptimerobot_psp_announcements_create', array_keys($provider->tools()));
    }

    public function test_service_injects_bearer_token_and_maps_path_query_arrays_and_json(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new UptimeRobotService('token', 'https://uptimerobot.example.test/v3');
        $service->request('GET', '/monitors', [], ['customField' => ['environment:production', 'team:core'], 'limit' => 2]);
        $service->request('GET', '/monitors/{id}', ['id' => 'monitor 1']);
        $service->request('POST', '/monitors', [], [], [], ['name' => 'Production API', 'url' => 'https://example.test/health']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://uptimerobot.example.test/v3/monitors?customField=environment%3Aproduction&customField=team%3Acore&limit=2'
            && $request->hasHeader('Authorization', 'Bearer token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://uptimerobot.example.test/v3/monitors/monitor%201');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://uptimerobot.example.test/v3/monitors'
            && $request['name'] === 'Production API');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new UptimeRobotService('token', 'https://uptimerobot.example.test/v3');

        self::assertTrue((new UptimeRobotMonitorsList($service))->execute(['limit' => 10])->succeeded());
        self::assertTrue((new UptimeRobotMonitorsGet($service))->execute(['id' => 'monitor-1'])->succeeded());
        self::assertTrue((new UptimeRobotMonitorsCreate($service))->execute(['body' => ['name' => 'Production API']])->succeeded());

        $missingPath = (new UptimeRobotMonitorsGet($service))->execute([]);
        $missingBody = (new UptimeRobotMonitorsCreate($service))->execute([]);
        $unconfigured = (new UptimeRobotMonitorsList(new UptimeRobotService('', 'https://uptimerobot.example.test/v3')))->execute([]);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('id must be', (string) $missingPath->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_current_user_endpoint(): void
    {
        Http::fake(['uptimerobot.example.test/v3/user/me' => Http::response(['email' => 'agent@example.test'], 200)]);

        $result = (new UptimeRobotToolProvider)->testConnection(['api_key' => 'token', 'url' => 'https://uptimerobot.example.test/v3']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://uptimerobot.example.test/v3/user/me'
            && $request->hasHeader('Authorization', 'Bearer token'));
    }
}
