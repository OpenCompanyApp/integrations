<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ZohoSheet;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetListSpreadsheets;
use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;
use OpenCompany\Integrations\ZohoSheet\ZohoSheetToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Zoho Sheet integration.
 */
final class ZohoSheetServiceTest extends TestCase
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
        $provider = new ZohoSheetToolProvider;

        self::assertSame('zoho-sheet', $provider->appName());
        self::assertSame('Zoho Sheet', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertCount(7, $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_uses_configured_base_url_bearer_header_and_pagination(): void
    {
        Http::fake([
            'https://sheet.example.test/api/v2/spreadsheets*' => Http::response([
                'spreadsheets' => [['resource_id' => 'sheet-1']],
            ], 200),
        ]);

        $result = (new ZohoSheetService(
            accessToken: 'token-test',
            baseUrl: 'https://sheet.example.test/',
        ))->listSpreadsheets(2, 25);

        self::assertSame('sheet-1', $result['spreadsheets'][0]['resource_id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://sheet.example.test/api/v2/spreadsheets?')
                && $query === ['page' => '2', 'per_page' => '25']
                && $request->hasHeader('Authorization', 'Bearer token-test');
        });
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://legacy-sheet.example.test/api/v2/spreadsheets*' => Http::response([
                'spreadsheets' => [],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'zoho-sheet') {
                    return '';
                }

                if ($integration === 'zoho_sheet' && $account === 'finance') {
                    return match ($key) {
                        'access_token' => 'legacy-token',
                        'url' => 'https://legacy-sheet.example.test',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'zoho_sheet' && $account === 'finance';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'zoho_sheet' ? ['finance'] : [];
            }
        });

        $tool = (new ZohoSheetToolProvider)->createTool(ZohoSheetListSpreadsheets::class, ['account' => 'finance']);
        $result = $tool->execute(['page' => 1]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://legacy-sheet.example.test/api/v2/spreadsheets?')
            && $request->hasHeader('Authorization', 'Bearer legacy-token'));
    }
}
