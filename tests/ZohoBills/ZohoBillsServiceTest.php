<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ZohoBills;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsListInvoices;
use OpenCompany\Integrations\ZohoBills\ZohoBillsService;
use OpenCompany\Integrations\ZohoBills\ZohoBillsToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Zoho Bills integration.
 */
final class ZohoBillsServiceTest extends TestCase
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
        $provider = new ZohoBillsToolProvider;

        self::assertSame('zoho-bills', $provider->appName());
        self::assertSame('Zoho Bills', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertCount(7, $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());
    }

    public function test_service_adds_organization_header_query_and_bearer_header(): void
    {
        Http::fake([
            'https://billing.example.test/api/v3/invoices*' => Http::response([
                'invoices' => [['invoice_id' => 'inv-1']],
            ], 200),
        ]);

        $result = (new ZohoBillsService(
            accessToken: 'token-test',
            organizationId: 'org-1',
            baseUrl: 'https://billing.example.test',
        ))->listInvoices(2, 25, 'paid');

        self::assertSame('inv-1', $result['invoices'][0]['invoice_id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://billing.example.test/api/v3/invoices?')
                && $query === ['page' => '2', 'per_page' => '25', 'status' => 'paid', 'organization_id' => 'org-1']
                && $request->hasHeader('Authorization', 'Bearer token-test')
                && $request->hasHeader('X-com-zoho-bills-organizationid', 'org-1');
        });
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://legacy-billing.example.test/api/v3/invoices*' => Http::response([
                'invoices' => [],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'zoho-bills') {
                    return '';
                }

                if ($integration === 'zoho_bills' && $account === 'billing') {
                    return match ($key) {
                        'access_token' => 'legacy-token',
                        'organization_id' => 'legacy-org',
                        'url' => 'https://legacy-billing.example.test',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'zoho_bills' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'zoho_bills' ? ['billing'] : [];
            }
        });

        $tool = (new ZohoBillsToolProvider)->createTool(ZohoBillsListInvoices::class, ['account' => 'billing']);
        $result = $tool->execute(['page' => 1]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://legacy-billing.example.test/api/v3/invoices?')
            && str_contains($request->url(), 'organization_id=legacy-org')
            && $request->hasHeader('Authorization', 'Bearer legacy-token')
            && $request->hasHeader('X-com-zoho-bills-organizationid', 'legacy-org'));
    }
}
