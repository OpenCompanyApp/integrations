<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\HealthchecksIo;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\HealthchecksIo\HealthchecksIoService;
use OpenCompany\Integrations\HealthchecksIo\HealthchecksIoToolProvider;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoCreateCheck;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoGetCheck;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoListChecks;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingExitStatusSlug;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingSuccessUuid;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Healthchecks.io Management and Pinging APIs.
 */
final class HealthchecksIoServiceTest extends TestCase
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

    public function test_provider_matches_manifest_and_docs(): void
    {
        $provider = new HealthchecksIoToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/healthchecks-io/healthchecks-io-api-manifest.json'), true);

        self::assertSame(23, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Healthchecks.io', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('healthchecks_io_list_checks', array_keys($provider->tools()));
        self::assertContains('healthchecks_io_ping_success_uuid', array_keys($provider->tools()));
        self::assertContains('healthchecks_io_ping_exit_status_slug', array_keys($provider->tools()));
    }

    public function test_service_maps_management_auth_query_path_json_and_ping_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200, ['Ping-Body-Limit' => '100000'])]);

        $service = new HealthchecksIoService('key', 'https://healthchecks.example.test/api/v3', 'https://ping.example.test');
        $service->request('GET', '/checks/', [], ['tag' => ['backup', 'prod']]);
        $service->request('GET', '/checks/{check_id}', ['check_id' => 'check 1']);
        $service->request('POST', '/checks/', [], [], ['name' => 'Database Backup']);
        $service->request('POST', '/{uuid}', ['uuid' => '00000000-0000-4000-8000-000000000000'], ['rid' => '11111111-1111-4111-8111-111111111111'], ['body_text' => 'completed'], false, true);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://healthchecks.example.test/api/v3/checks/?tag=backup&tag=prod'
            && $request->hasHeader('X-Api-Key', 'key'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://healthchecks.example.test/api/v3/checks/check%201');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://healthchecks.example.test/api/v3/checks/'
            && $request['name'] === 'Database Backup');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://ping.example.test/00000000-0000-4000-8000-000000000000?rid=11111111-1111-4111-8111-111111111111'
            && !$request->hasHeader('X-Api-Key'));
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new HealthchecksIoService('key', 'https://healthchecks.example.test/api/v3', 'https://ping.example.test');

        self::assertTrue((new HealthchecksIoListChecks($service))->execute(['tag' => ['backup']])->succeeded());
        self::assertTrue((new HealthchecksIoGetCheck($service))->execute(['check_id' => 'unique-key-example'])->succeeded());
        self::assertTrue((new HealthchecksIoCreateCheck($service))->execute(['body' => ['slug' => 'database-backup']])->succeeded());
        self::assertTrue((new HealthchecksIoPingSuccessUuid(new HealthchecksIoService('', 'https://healthchecks.example.test/api/v3', 'https://ping.example.test')))->execute(['uuid' => '00000000-0000-4000-8000-000000000000', 'http_method' => 'GET'])->succeeded());
        self::assertTrue((new HealthchecksIoPingExitStatusSlug(new HealthchecksIoService('', 'https://healthchecks.example.test/api/v3', 'https://ping.example.test')))->execute(['ping_key' => 'ping-key-example', 'slug' => 'database-backup', 'exit_status' => 1, 'create' => 1])->succeeded());

        $missingPath = (new HealthchecksIoGetCheck($service))->execute([]);
        $badBody = (new HealthchecksIoCreateCheck($service))->execute(['body' => 'not-object']);
        $badMethod = (new HealthchecksIoPingSuccessUuid($service))->execute(['uuid' => '00000000-0000-4000-8000-000000000000', 'http_method' => 'PUT']);
        $unconfigured = (new HealthchecksIoListChecks(new HealthchecksIoService('', 'https://healthchecks.example.test/api/v3')))->execute([]);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('check_id must be', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($badMethod->succeeded());
        self::assertStringContainsString('http_method must be', (string) $badMethod->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_status_endpoint(): void
    {
        Http::fake(['healthchecks.example.test/api/v3/status/' => Http::response(['status' => 'ok'], 200)]);

        $result = (new HealthchecksIoToolProvider)->testConnection(['api_key' => 'key', 'url' => 'https://healthchecks.example.test/api/v3']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://healthchecks.example.test/api/v3/status/'
            && $request->hasHeader('X-Api-Key', 'key'));
    }
}
