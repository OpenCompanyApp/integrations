<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ZohoBooks;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksListInvoices;
use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\Integrations\ZohoBooks\ZohoBooksToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Zoho Books integration.
 */
final class ZohoBooksServiceTest extends TestCase
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
        $provider = new ZohoBooksToolProvider;

        self::assertSame('zoho-books', $provider->appName());
        self::assertSame('Zoho Books', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertCount(12, $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());
    }

    public function test_service_adds_organization_id_and_oauth_header(): void
    {
        Http::fake([
            'https://books.example.test/books/v3/invoices*' => Http::response([
                'invoices' => [['invoice_id' => 'inv-1']],
            ], 200),
        ]);

        $result = (new ZohoBooksService(
            accessToken: 'token-test',
            organizationId: 'org-1',
            baseUrl: 'https://books.example.test/books/v3',
        ))->listInvoices(['page' => 2, 'per_page' => 25]);

        self::assertSame('inv-1', $result['invoices'][0]['invoice_id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://books.example.test/books/v3/invoices?')
                && $query === ['page' => '2', 'per_page' => '25', 'organization_id' => 'org-1']
                && $request->hasHeader('Authorization', 'Zoho-oauthtoken token-test');
        });
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://legacy-books.example.test/books/v3/invoices*' => Http::response([
                'invoices' => [],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'zoho-books') {
                    return '';
                }

                if ($integration === 'zoho_books' && $account === 'books') {
                    return match ($key) {
                        'access_token' => 'legacy-token',
                        'organization_id' => 'legacy-org',
                        'url' => 'https://legacy-books.example.test/books/v3',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'zoho_books' && $account === 'books';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'zoho_books' ? ['books'] : [];
            }
        });

        $tool = (new ZohoBooksToolProvider)->createTool(ZohoBooksListInvoices::class, ['account' => 'books']);
        $result = $tool->execute(['page' => 1]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://legacy-books.example.test/books/v3/invoices?')
            && str_contains($request->url(), 'organization_id=legacy-org')
            && $request->hasHeader('Authorization', 'Zoho-oauthtoken legacy-token'));
    }
}
