<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Ipstack;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Ipstack\IpstackService;
use OpenCompany\Integrations\Ipstack\IpstackToolProvider;
use OpenCompany\Integrations\Ipstack\Tools\IpstackLookupBulk;
use OpenCompany\Integrations\Ipstack\Tools\IpstackLookupIp;
use OpenCompany\Integrations\Ipstack\Tools\IpstackLookupRequester;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for IPstack official endpoint mapping.
 */
final class IpstackServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(IpstackService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(IpstackService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_official_ipstack_endpoints_only(): void
    {
        $provider = new IpstackToolProvider;

        self::assertSame('ipstack', $provider->appName());
        self::assertSame('IPstack', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertCount(3, $provider->tools());
        self::assertArrayHasKey('ipstack_lookup_ip', $provider->tools());
        self::assertArrayHasKey('ipstack_lookup_bulk', $provider->tools());
        self::assertArrayHasKey('ipstack_lookup_requester', $provider->tools());
        self::assertArrayNotHasKey('ipstack_get_timezone', $provider->tools());
        self::assertArrayNotHasKey('ipstack_get_current_user', $provider->tools());
    }

    public function test_standard_bulk_and_requester_urls_match_documented_shapes(): void
    {
        $service = new IpstackService('token-123', 'https://api.example.test');

        Http::fake(['*' => Http::response(['ip' => '134.201.250.155'], 200)]);
        self::assertTrue((new IpstackLookupIp($service))->execute([
            'ip' => '134.201.250.155',
            'fields' => ['main', 'location'],
            'language' => 'de',
            'hostname' => true,
            'security' => true,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/134.201.250.155?')
            && str_contains($request->url(), 'access_key=token-123')
            && str_contains($request->url(), 'fields=main%2Clocation')
            && str_contains($request->url(), 'language=de')
            && str_contains($request->url(), 'hostname=1')
            && str_contains($request->url(), 'security=1'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['ip' => '134.201.250.155']], 200)]);
        self::assertTrue((new IpstackLookupBulk($service))->execute([
            'ips' => ['134.201.250.155', '72.229.28.185'],
            'fields' => 'main,connection',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/134.201.250.155,72.229.28.185?')
            && str_contains($request->url(), 'fields=main%2Cconnection'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['ip' => '198.51.100.10'], 200)]);
        self::assertTrue((new IpstackLookupRequester($service))->execute([
            'fields' => ['main'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/check?')
            && str_contains($request->url(), 'fields=main'));
    }

    public function test_multi_account_resolution_uses_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['ip' => '134.201.250.155'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['ipstack', 'api_key', 'workspace'] => 'account-token',
                    ['ipstack', 'url', 'workspace'] => 'https://account.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'ipstack' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'ipstack' ? ['workspace'] : [];
            }
        });

        $tool = (new IpstackToolProvider)->createTool(IpstackLookupIp::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute(['ip' => '134.201.250.155'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://account.example.test/134.201.250.155?')
            && str_contains($request->url(), 'access_key=account-token'));
    }
}
