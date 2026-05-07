<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\LaunchDarkly;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;
use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyToolProvider;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyApiGet;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyCreateFeatureFlag;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyInviteMembers;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyUpdateFeatureFlag;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for LaunchDarkly endpoint coverage and metadata.
 */
final class LaunchDarklyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(LaunchDarklyService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(LaunchDarklyService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_supports_raw_launchdarkly_methods_and_token_auth(): void
    {
        Http::fake(['*' => Http::response(['items' => []], 200)]);

        $service = new LaunchDarklyService('ld-token', 'default');
        $service->apiGet('/projects', ['limit' => 10]);
        $service->apiPost('/flags/default', ['key' => 'checkout-flow']);
        $service->apiPatch('/flags/default/checkout-flow', [['op' => 'replace', 'path' => '/name', 'value' => 'Checkout']]);
        $service->apiPut('/example', ['enabled' => true]);
        $service->apiDelete('/flags/default/checkout-flow');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'ld-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://app.launchdarkly.com/api/v2/projects?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://app.launchdarkly.com/api/v2/flags/default'
            && $request['key'] === 'checkout-flow');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://app.launchdarkly.com/api/v2/flags/default/checkout-flow'
            && str_contains($request->body(), '"path":"\/name"'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://app.launchdarkly.com/api/v2/example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://app.launchdarkly.com/api/v2/flags/default/checkout-flow');
    }

    public function test_endpoint_tools_map_paths_query_and_bodies(): void
    {
        $service = new LaunchDarklyService('ld-token', 'default');

        Http::fake(['*' => Http::response(['items' => []], 200)]);
        self::assertTrue((new LaunchDarklyApiGet($service))->execute([
            'path' => '/projects',
            'query' => ['limit' => 5],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://app.launchdarkly.com/api/v2/projects?limit=5');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['key' => 'checkout-flow'], 201)]);
        self::assertTrue((new LaunchDarklyCreateFeatureFlag($service))->execute([
            'project_key' => 'web-app',
            'key' => 'checkout-flow',
            'name' => 'Checkout Flow',
            'temporary' => true,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://app.launchdarkly.com/api/v2/flags/web-app'
            && $request['key'] === 'checkout-flow'
            && $request['temporary'] === true);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['key' => 'checkout-flow'], 200)]);
        self::assertTrue((new LaunchDarklyUpdateFeatureFlag($service))->execute([
            'project_key' => 'web-app',
            'feature_flag_key' => 'checkout-flow',
            'patch' => [['op' => 'replace', 'path' => '/environments/production/on', 'value' => true]],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->body(), 'production'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 201)]);
        self::assertTrue((new LaunchDarklyInviteMembers($service))->execute([
            'body' => [
                ['email' => 'person@example.test', 'role' => 'reader'],
            ],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://app.launchdarkly.com/api/v2/members'
            && $request[0]['email'] === 'person@example.test');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new LaunchDarklyToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://launchdarkly.com/docs/api', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(38, count($tools));
        self::assertArrayHasKey('launchdarkly_api_get', $tools);
        self::assertArrayHasKey('launchdarkly_create_feature_flag', $tools);
        self::assertArrayHasKey('launchdarkly_list_segments', $tools);
        self::assertArrayHasKey('launchdarkly_invite_members', $tools);
        self::assertArrayHasKey('launchdarkly_list_teams', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new LaunchDarklyService('ld-token', 'default'));
            $names[] = $instance->name();
        }
        self::assertCount(count($names), array_unique($names));

        self::assertSame(['success' => false, 'error' => 'No access token provided.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['firstName' => 'Ada', 'lastName' => 'Lovelace'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to LaunchDarkly as Ada Lovelace.'], $provider->testConnection([
            'access_token' => 'ld-token',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://app.launchdarkly.com/api/v2/members/me');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['launchdarkly', 'access_token', 'ops'] => 'account-token',
                    ['launchdarkly', 'project_key', 'ops'] => 'account-project',
                    ['launchdarkly', 'url', 'ops'] => 'https://launchdarkly.example.test/api/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'launchdarkly' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'launchdarkly' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(LaunchDarklyApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/projects'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://launchdarkly.example.test/api/v2/projects'
            && $request->hasHeader('Authorization', 'account-token'));
    }
}
