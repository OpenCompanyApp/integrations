<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Cloudflare;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Cloudflare\CloudflareService;
use OpenCompany\Integrations\Cloudflare\CloudflareToolProvider;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareApiGet;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareCreateZoneRuleset;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflarePatchDnsRecord;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflarePurgeCache;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Cloudflare endpoint coverage and metadata.
 */
final class CloudflareServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CloudflareService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CloudflareService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_supports_raw_cloudflare_methods_and_token_auth(): void
    {
        Http::fake(['*' => Http::response(['success' => true, 'result' => []], 200)]);

        $service = new CloudflareService('cf-token');
        $service->apiGet('/zones', ['page' => 2]);
        $service->apiPost('/zones/zone-123/purge_cache', ['purge_everything' => true]);
        $service->apiPatch('/zones/zone-123/dns_records/record-123', ['content' => '192.0.2.10']);
        $service->apiPut('/zones/zone-123/rulesets/ruleset-123', ['rules' => []]);
        $service->apiDelete('/zones/zone-123/dns_records/record-123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer cf-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.cloudflare.com/client/v4/zones?page=2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.cloudflare.com/client/v4/zones/zone-123/purge_cache'
            && $request['purge_everything'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://api.cloudflare.com/client/v4/zones/zone-123/dns_records/record-123'
            && $request['content'] === '192.0.2.10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.cloudflare.com/client/v4/zones/zone-123/rulesets/ruleset-123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.cloudflare.com/client/v4/zones/zone-123/dns_records/record-123');
    }

    public function test_endpoint_tools_map_paths_query_and_bodies(): void
    {
        $service = new CloudflareService('cf-token');

        Http::fake(['*' => Http::response(['success' => true, 'result' => []], 200)]);
        self::assertTrue((new CloudflareApiGet($service))->execute([
            'path' => '/zones/zone-123/settings',
            'query' => ['page' => 1],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudflare.com/client/v4/zones/zone-123/settings?page=1');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['success' => true, 'result' => []], 200)]);
        self::assertTrue((new CloudflarePatchDnsRecord($service))->execute([
            'zone_id' => 'zone-123',
            'dns_record_id' => 'record-123',
            'content' => '192.0.2.11',
            'proxied' => false,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudflare.com/client/v4/zones/zone-123/dns_records/record-123'
            && $request['content'] === '192.0.2.11'
            && $request['proxied'] === false);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['success' => true, 'result' => []], 200)]);
        self::assertTrue((new CloudflarePurgeCache($service))->execute([
            'zone_id' => 'zone-123',
            'files' => ['https://example.test/app.css'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request['files'] === ['https://example.test/app.css']);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['success' => true, 'result' => []], 200)]);
        self::assertTrue((new CloudflareCreateZoneRuleset($service))->execute([
            'zone_id' => 'zone-123',
            'name' => 'Block test traffic',
            'kind' => 'zone',
            'phase' => 'http_request_firewall_custom',
            'rules' => [['action' => 'block', 'expression' => 'ip.src eq 192.0.2.1']],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request['phase'] === 'http_request_firewall_custom'
            && $request['rules'][0]['action'] === 'block');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new CloudflareToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.cloudflare.com/api/', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(45, count($tools));
        self::assertArrayHasKey('cloudflare_api_get', $tools);
        self::assertArrayHasKey('cloudflare_patch_dns_record', $tools);
        self::assertArrayHasKey('cloudflare_list_zone_rulesets', $tools);
        self::assertArrayHasKey('cloudflare_list_kv_namespaces', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new CloudflareService('cf-token'));
            $names[] = $instance->name();
        }
        self::assertCount(count($names), array_unique($names));

        self::assertSame(['success' => false, 'error' => 'No API token provided.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['success' => true, 'result' => ['status' => 'active']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Cloudflare API; token status is active.'], $provider->testConnection([
            'access_token' => 'cf-token',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudflare.com/client/v4/user/tokens/verify');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['success' => true, 'result' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['cloudflare', 'access_token', 'ops'] => 'account-token',
                    ['cloudflare', 'url', 'ops'] => 'https://cloudflare.example.test/client/v4',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'cloudflare' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'cloudflare' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(CloudflareApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/zones'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cloudflare.example.test/client/v4/zones'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
