<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Confluent;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Confluent\ConfluentOperations;
use OpenCompany\Integrations\Confluent\ConfluentService;
use OpenCompany\Integrations\Confluent\ConfluentToolProvider;
use OpenCompany\Integrations\Confluent\Tools\ConfluentGetTopic;
use OpenCompany\Integrations\Confluent\Tools\ConfluentListEnvironments;
use PHPUnit\Framework\TestCase;

final class ConfluentServiceTest extends TestCase
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
        $provider = new ConfluentToolProvider;

        self::assertSame('confluent', $provider->appName());
        self::assertSame('Confluent Cloud', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.confluent.io/cloud/current/openapi.yaml', $provider->integrationMeta()['source_url']);
        self::assertCount(486, ConfluentOperations::all());
        self::assertCount(486, $provider->tools());
        self::assertArrayHasKey('confluent_list_topics', $provider->tools());
        self::assertArrayHasKey('confluent_get_topic', $provider->tools());
        self::assertArrayHasKey('confluent_create_topic', $provider->tools());
        self::assertArrayHasKey('confluent_list_clusters', $provider->tools());
        self::assertArrayHasKey('confluent_get_cluster', $provider->tools());
        self::assertArrayHasKey('confluent_list_environments', $provider->tools());
        self::assertArrayNotHasKey('confluent_get_current_user', $provider->tools());
    }

    public function test_service_maps_common_endpoints_and_basic_auth(): void
    {
        Http::fake([
            'https://api.example.test/org/v2/environments?page_size=1' => Http::response(['data' => [['id' => 'env-1']]], 200),
            'https://api.example.test/cmk/v2/clusters?environment=env-1' => Http::response(['data' => [['id' => 'lkc-1']]], 200),
            'https://api.example.test/kafka/v3/clusters/lkc-1/topics' => Http::response(['data' => [['topic_name' => 'orders']]], 200),
            'https://api.example.test/kafka/v3/clusters/lkc-1/topics/orders' => Http::response(['topic_name' => 'orders'], 200),
        ]);

        $service = new ConfluentService(apiKey: 'cloud-key', apiSecret: 'cloud-secret', clusterId: 'lkc-1', baseUrl: 'https://api.example.test');

        self::assertSame('env-1', $service->listEnvironments(['page_size' => 1])['data'][0]['id']);
        self::assertSame('lkc-1', $service->listClusters(['environment' => 'env-1'])['data'][0]['id']);
        self::assertSame('orders', $service->listTopics()['data'][0]['topic_name']);
        self::assertSame('orders', $service->getTopic('orders')['topic_name']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic ' . base64_encode('cloud-key:cloud-secret')));
    }

    public function test_generated_tools_map_path_query_body_and_missing_required_parameters(): void
    {
        Http::fake([
            'https://api.example.test/kafka/v3/clusters/lkc-1/topics/orders' => Http::response(['topic_name' => 'orders'], 200),
            'https://api.example.test/kafka/v3/clusters/lkc-1/topics' => Http::response(['topic_name' => 'created'], 201),
        ]);

        $service = new ConfluentService(accessToken: 'confluent-token', baseUrl: 'https://api.example.test');

        $get = new ConfluentGetTopic($service);
        $success = $get->execute(['cluster_id' => 'lkc-1', 'topic_name' => 'orders']);
        self::assertTrue($success->succeeded());
        self::assertSame('orders', $success->data['topic_name']);

        $missing = $get->execute(['cluster_id' => 'lkc-1']);
        self::assertFalse($missing->succeeded());
        self::assertSame('The topic_name parameter is required.', $missing->error);

        $created = $service->executeOperation(ConfluentOperations::all()['confluent_create_topic'], ['cluster_id' => 'lkc-1', 'topic_name' => 'created', 'partitions_count' => 6]);
        self::assertSame('created', $created['topic_name']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/kafka/v3/clusters/lkc-1/topics'
            && $request['topic_name'] === 'created'
            && $request['partitions_count'] === 6
            && $request->hasHeader('Authorization', 'Bearer confluent-token'));
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-confluent.example.test/org/v2/environments?page_size=1' => Http::response(['data' => [['id' => 'env-tenant']]], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'confluent' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-token',
                    'url' => 'https://tenant-confluent.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'confluent' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'confluent' ? ['work'] : [];
            }
        });

        $tool = (new ConfluentToolProvider)->createTool(ConfluentListEnvironments::class, ['account' => 'work']);
        $result = $tool->execute(['page_size' => 1]);

        self::assertTrue($result->succeeded());
        self::assertSame('env-tenant', $result->data['data'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://tenant-confluent.example.test/org/v2/environments?page_size=1'
            && $request->hasHeader('Authorization', 'Bearer tenant-token'));
    }
}
