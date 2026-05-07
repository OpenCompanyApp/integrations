<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Vultr;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Vultr\Tools\VultrGetCurrentUser;
use OpenCompany\Integrations\Vultr\Tools\VultrGetInstance;
use OpenCompany\Integrations\Vultr\Tools\VultrStartInstance;
use OpenCompany\Integrations\Vultr\VultrOperations;
use OpenCompany\Integrations\Vultr\VultrService;
use OpenCompany\Integrations\Vultr\VultrToolProvider;
use PHPUnit\Framework\TestCase;

final class VultrServiceTest extends TestCase
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
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_generated_metadata_and_preserved_tools(): void
    {
        $provider = new VultrToolProvider;

        self::assertSame('vultr', $provider->appName());
        self::assertSame('Vultr', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://www.vultr.com/api/', $provider->integrationMeta()['source_url']);
        self::assertCount(522, VultrOperations::all());
        self::assertCount(522, $provider->tools());
        self::assertArrayHasKey('vultr_list_instances', $provider->tools());
        self::assertArrayHasKey('vultr_get_instance', $provider->tools());
        self::assertArrayHasKey('vultr_list_regions', $provider->tools());
        self::assertArrayHasKey('vultr_list_plans', $provider->tools());
        self::assertArrayHasKey('vultr_list_snapshots', $provider->tools());
        self::assertArrayHasKey('vultr_list_ssh_keys', $provider->tools());
        self::assertArrayHasKey('vultr_get_current_user', $provider->tools());
        self::assertArrayHasKey('vultr_create_instance', $provider->tools());
        self::assertArrayHasKey('vultr_list_iam_policies', $provider->tools());
    }

    public function test_service_maps_common_endpoints_and_bearer_header(): void
    {
        Http::fake([
            'https://api.example.test/v2/account' => Http::response(['account' => ['email' => 'agent@example.test']], 200),
            'https://api.example.test/v2/instances?per_page=50' => Http::response(['instances' => [['id' => 'instance-1']]], 200),
            'https://api.example.test/v2/instances/instance-1' => Http::response(['instance' => ['id' => 'instance-1']], 200),
            'https://api.example.test/v2/plans?type=vc2' => Http::response(['plans' => []], 200),
            'https://api.example.test/v2/regions' => Http::response(['regions' => []], 200),
        ]);

        $service = new VultrService(accessToken: 'vultr-token', baseUrl: 'https://api.example.test/v2');

        self::assertSame('agent@example.test', $service->getCurrentUser()['account']['email']);
        self::assertSame('instance-1', $service->listInstances(['per_page' => 50])['instances'][0]['id']);
        self::assertSame('instance-1', $service->getInstance('instance-1')['instance']['id']);
        self::assertSame([], $service->listPlans(['type' => 'vc2'])['plans']);
        self::assertSame([], $service->listRegions()['regions']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/v2/account'
            && $request->hasHeader('Authorization', 'Bearer vultr-token'));
    }

    public function test_generated_tools_map_path_query_body_and_v2_paths(): void
    {
        Http::fake([
            'https://api.example.test/v2/instances/instance-1' => Http::response(['instance' => ['id' => 'instance-1']], 200),
            'https://api.example.test/v2/instances/instance-1/start' => Http::response([], 204),
            'https://api.example.test/v2/policies' => Http::response(['policies' => [['id' => 'policy-1']]], 200),
        ]);

        $service = new VultrService(accessToken: 'vultr-token', baseUrl: 'https://api.example.test/v2');

        $get = new VultrGetInstance($service);
        $success = $get->execute(['id' => 'instance-1']);
        self::assertTrue($success->succeeded());
        self::assertSame('instance-1', $success->data['instance']['id']);

        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('The id parameter is required.', $missing->error);

        $start = new VultrStartInstance($service);
        $started = $start->execute(['id' => 'instance-1']);
        self::assertTrue($started->succeeded());

        $policies = $service->executeOperation(VultrOperations::all()['vultr_list_iam_policies'], []);
        self::assertSame('policy-1', $policies['policies'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v2/policies');
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-vultr.example.test/v2/account' => Http::response(['account' => ['email' => 'tenant@example.test']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'vultr' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-vultr-token',
                    'url' => 'https://tenant-vultr.example.test/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'vultr' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'vultr' ? ['work'] : [];
            }
        });

        $tool = (new VultrToolProvider)->createTool(VultrGetCurrentUser::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant@example.test', $result->data['account']['email']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://tenant-vultr.example.test/v2/account'
            && $request->hasHeader('Authorization', 'Bearer tenant-vultr-token'));
    }
}
