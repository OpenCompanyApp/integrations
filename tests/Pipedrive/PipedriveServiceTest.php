<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Pipedrive;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Pipedrive\PipedriveOperations;
use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\Integrations\Pipedrive\PipedriveToolProvider;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetCurrentUser;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetDeal;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListDeals;
use PHPUnit\Framework\TestCase;

final class PipedriveServiceTest extends TestCase
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
        $provider = new PipedriveToolProvider;

        self::assertSame('pipedrive', $provider->appName());
        self::assertSame('Pipedrive', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertStringContainsString('/v1/openapi.yaml', $provider->integrationMeta()['source_url']);
        self::assertStringContainsString('/v2/openapi.yaml', $provider->integrationMeta()['source_url']);
        self::assertCount(371, PipedriveOperations::all());
        self::assertCount(371, $provider->tools());
        self::assertArrayHasKey('pipedrive_list_deals', $provider->tools());
        self::assertArrayHasKey('pipedrive_get_deal', $provider->tools());
        self::assertArrayHasKey('pipedrive_create_deal', $provider->tools());
        self::assertArrayHasKey('pipedrive_list_persons', $provider->tools());
        self::assertArrayHasKey('pipedrive_get_current_user', $provider->tools());
        self::assertArrayHasKey('pipedrive_v2_search_item', $provider->tools());
    }

    public function test_service_maps_v1_and_v2_endpoints_with_api_token_header(): void
    {
        Http::fake([
            'https://api.example.test/api/v2/deals/123' => Http::response(['data' => ['id' => 123]], 200),
            'https://api.example.test/api/v2/deals*' => Http::response(['data' => [['id' => 123]]], 200),
            'https://api.example.test/api/v2/itemSearch*' => Http::response(['data' => ['items' => [['id' => 456]]]], 200),
            'https://api.example.test/v1/users/me' => Http::response(['data' => ['email' => 'agent@example.test']], 200),
        ]);

        $service = new PipedriveService(apiToken: 'pd-token', baseUrl: 'https://api.example.test/v1');

        self::assertSame(['data' => [['id' => 123]]], $service->listDeals(status: 'open', limit: 10, start: 5));
        self::assertSame(['data' => ['id' => 123]], $service->getDeal(123));
        self::assertSame(['data' => ['email' => 'agent@example.test']], $service->getCurrentUser());
        self::assertSame(['data' => ['items' => [['id' => 456]]]], $service->executeOperation(PipedriveOperations::all()['pipedrive_v2_search_item'], ['term' => 'Example']));

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://api.example.test/api/v2/deals?')
                && ($query['status'] ?? null) === 'open'
                && ($query['limit'] ?? null) === '10'
                && $request->hasHeader('x-api-token', 'pd-token');
        });
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/api/v2/itemSearch?')
            && $request->hasHeader('x-api-token', 'pd-token'));
    }

    public function test_generated_tools_map_path_query_and_body_arguments(): void
    {
        Http::fake([
            'https://api.example.test/api/v2/deals/123' => Http::response(['data' => ['id' => 123]], 200),
            'https://api.example.test/api/v2/deals*' => Http::response(['data' => [['id' => 123]]], 200),
        ]);

        $service = new PipedriveService(apiToken: 'pd-token', baseUrl: 'https://api.example.test');

        $get = new PipedriveGetDeal($service);
        $success = $get->execute(['id' => 123]);
        self::assertTrue($success->succeeded());
        self::assertSame(123, $success->data['data']['id']);

        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('The id parameter is required.', $missing->error);

        $list = new PipedriveListDeals($service);
        $listed = $list->execute(['status' => 'open', 'limit' => 10]);
        self::assertTrue($listed->succeeded());
        self::assertSame(123, $listed->data['data'][0]['id']);

        $created = $service->executeOperation(PipedriveOperations::all()['pipedrive_create_deal'], [
            'title' => 'Example opportunity',
            'value' => 12000,
        ]);
        self::assertSame(123, $created['data'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v2/deals'
            && $request['title'] === 'Example opportunity'
            && $request['value'] === 12000);
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-api.example.test/v1/users/me' => Http::response(['data' => ['email' => 'tenant@example.test']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'pipedrive' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'api_token' => 'tenant-pd-token',
                    'base_url' => 'https://tenant-api.example.test/api/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'pipedrive' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'pipedrive' ? ['work'] : [];
            }
        });

        $tool = (new PipedriveToolProvider)->createTool(PipedriveGetCurrentUser::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant@example.test', $result->data['data']['email']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-api.example.test/v1/users/me'
            && $request->hasHeader('x-api-token', 'tenant-pd-token'));
    }
}
