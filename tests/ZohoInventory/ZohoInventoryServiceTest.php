<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ZohoInventory;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryListItems;
use OpenCompany\Integrations\ZohoInventory\ZohoInventoryService;
use OpenCompany\Integrations\ZohoInventory\ZohoInventoryToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Zoho Inventory integration.
 */
final class ZohoInventoryServiceTest extends TestCase
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

    public function test_provider_uses_canonical_namespace_allowed_category_and_docs(): void
    {
        $provider = new ZohoInventoryToolProvider;

        self::assertSame('zoho-inventory', $provider->appName());
        self::assertSame('Zoho Inventory', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertCount(7, $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_adds_organization_id_and_bearer_header(): void
    {
        Http::fake([
            'https://inventory.example.test/inventory/api/v1/items*' => Http::response([
                'items' => [['item_id' => 'item-1']],
            ], 200),
        ]);

        $result = (new ZohoInventoryService(
            accessToken: 'token-test',
            organizationId: 'org-1',
            baseUrl: 'https://inventory.example.test/inventory',
        ))->listItems(2, 25, 'active');

        self::assertSame('item-1', $result['items'][0]['item_id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://inventory.example.test/inventory/api/v1/items?')
                && $query === ['page' => '2', 'per_page' => '25', 'status' => 'active', 'organization_id' => 'org-1']
                && $request->hasHeader('Authorization', 'Bearer token-test');
        });
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://legacy-inventory.example.test/inventory/api/v1/items*' => Http::response([
                'items' => [],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'zoho-inventory') {
                    return '';
                }

                if ($integration === 'zoho_inventory' && $account === 'warehouse') {
                    return match ($key) {
                        'access_token' => 'legacy-token',
                        'organization_id' => 'legacy-org',
                        'url' => 'https://legacy-inventory.example.test/inventory',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'zoho_inventory' && $account === 'warehouse';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'zoho_inventory' ? ['warehouse'] : [];
            }
        });

        $tool = (new ZohoInventoryToolProvider)->createTool(ZohoInventoryListItems::class, ['account' => 'warehouse']);
        $result = $tool->execute(['page' => 1]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://legacy-inventory.example.test/inventory/api/v1/items?')
            && str_contains($request->url(), 'organization_id=legacy-org')
            && $request->hasHeader('Authorization', 'Bearer legacy-token'));
    }
}
