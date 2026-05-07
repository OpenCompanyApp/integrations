<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ZohoInvoice;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ZohoInvoice\Tools\ZohoInvoiceListInvoices;
use OpenCompany\Integrations\ZohoInvoice\ZohoInvoiceService;
use OpenCompany\Integrations\ZohoInvoice\ZohoInvoiceToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Zoho Invoice integration.
 */
final class ZohoInvoiceServiceTest extends TestCase
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
        $provider = new ZohoInvoiceToolProvider;

        self::assertSame('zoho-invoice', $provider->appName());
        self::assertSame('Zoho Invoice', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertCount(7, $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_adds_organization_id_and_bearer_header(): void
    {
        Http::fake([
            'https://invoice.example.test/api/v3/invoices*' => Http::response([
                'invoices' => [['invoice_id' => 'inv-1']],
            ], 200),
        ]);

        $result = (new ZohoInvoiceService(
            accessToken: 'token-test',
            baseUrl: 'https://invoice.example.test/api/v3',
            organizationId: 'org-1',
        ))->listInvoices(['page' => 2]);

        self::assertSame('inv-1', $result['invoices'][0]['invoice_id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://invoice.example.test/api/v3/invoices?')
                && $query === ['organization_id' => 'org-1', 'page' => '2']
                && $request->hasHeader('Authorization', 'Bearer token-test');
        });
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://legacy-invoice.example.test/api/v3/invoices*' => Http::response([
                'invoices' => [],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'zoho-invoice') {
                    return '';
                }

                if ($integration === 'zoho_invoice' && $account === 'billing') {
                    return match ($key) {
                        'access_token' => 'legacy-token',
                        'organization_id' => 'legacy-org',
                        'base_url' => 'https://legacy-invoice.example.test/api/v3',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'zoho_invoice' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'zoho_invoice' ? ['billing'] : [];
            }
        });

        $tool = (new ZohoInvoiceToolProvider)->createTool(ZohoInvoiceListInvoices::class, ['account' => 'billing']);
        $result = $tool->execute(['page' => 1]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://legacy-invoice.example.test/api/v3/invoices?')
            && str_contains($request->url(), 'organization_id=legacy-org')
            && $request->hasHeader('Authorization', 'Bearer legacy-token'));
    }
}
