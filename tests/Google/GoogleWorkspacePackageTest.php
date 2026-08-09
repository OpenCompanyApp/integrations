<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Google;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Google\GmailToolProvider;
use OpenCompany\Integrations\Google\GoogleAnalyticsToolProvider;
use OpenCompany\Integrations\Google\GoogleCalendarToolProvider;
use OpenCompany\Integrations\Google\GoogleContactsToolProvider;
use OpenCompany\Integrations\Google\GoogleDocsToolProvider;
use OpenCompany\Integrations\Google\GoogleDriveToolProvider;
use OpenCompany\Integrations\Google\GoogleFormsToolProvider;
use OpenCompany\Integrations\Google\GoogleSearchConsoleToolProvider;
use OpenCompany\Integrations\Google\GoogleServiceProvider;
use OpenCompany\Integrations\Google\GoogleSheetsToolProvider;
use OpenCompany\Integrations\Google\GoogleTasksToolProvider;
use OpenCompany\Integrations\Google\Services\GoogleSheetsService;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsGetMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the legacy Google Workspace package metadata and credentials.
 */
final class GoogleWorkspacePackageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        Container::getInstance()->forgetInstance(GoogleSheetsService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        Container::getInstance()->forgetInstance(GoogleSheetsService::class);
        parent::tearDown();
    }

    public function test_workspace_providers_use_canonical_app_ids_and_allowed_categories(): void
    {
        $providers = [
            'gmail' => new GmailToolProvider,
            'google-analytics' => new GoogleAnalyticsToolProvider,
            'google-calendar' => new GoogleCalendarToolProvider,
            'google-contacts' => new GoogleContactsToolProvider,
            'google-docs' => new GoogleDocsToolProvider,
            'google-drive' => new GoogleDriveToolProvider,
            'google-forms' => new GoogleFormsToolProvider,
            'google-search-console' => new GoogleSearchConsoleToolProvider,
            'google-sheets' => new GoogleSheetsToolProvider,
            'google-tasks' => new GoogleTasksToolProvider,
        ];

        foreach ($providers as $appId => $provider) {
            self::assertSame($appId, $provider->appName());
            self::assertContains($provider->integrationMeta()['category'], ['productivity', 'analytics', 'data', 'rendering']);
            self::assertFileExists((string) $provider->scriptDocsPath());
        }
    }

    public function test_service_provider_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://sheets.googleapis.com/v4/spreadsheets/sheet-1*' => Http::response([
                'spreadsheetId' => 'sheet-1',
                'properties' => ['title' => 'Forecast'],
                'sheets' => [],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'google-sheets') {
                    return '';
                }

                if ($integration === 'google_sheets') {
                    return match ($key) {
                        'access_token' => 'legacy-token',
                        'expires_at' => time() + 3600,
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'google_sheets';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'google_sheets' ? ['default'] : [];
            }
        });

        (new GoogleServiceProvider(Container::getInstance()))->register();
        $result = Container::getInstance()->make(GoogleSheetsService::class)->getMetadata('sheet-1');

        self::assertSame('Forecast', $result['properties']['title']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sheets.googleapis.com/v4/spreadsheets/sheet-1?fields=spreadsheetId%2Cproperties.title%2Csheets.properties'
            && $request->hasHeader('Authorization', 'Bearer legacy-token'));
    }

    public function test_named_account_tool_resolution_uses_legacy_credentials_when_canonical_missing(): void
    {
        Http::fake([
            'https://sheets.googleapis.com/v4/spreadsheets/sheet-1*' => Http::response([
                'spreadsheetId' => 'sheet-1',
                'properties' => ['title' => 'Forecast'],
                'sheets' => [],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'google-sheets') {
                    return '';
                }

                if ($integration === 'google_sheets' && $account === 'finance') {
                    return match ($key) {
                        'access_token' => 'account-token',
                        'expires_at' => time() + 3600,
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'google_sheets' && $account === 'finance';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'google_sheets' ? ['finance'] : [];
            }
        });

        $tool = (new GoogleSheetsToolProvider)->createTool(GoogleSheetsGetMetadata::class, ['account' => 'finance']);
        $result = $tool->execute(['spreadsheet_id' => 'sheet-1']);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sheets.googleapis.com/v4/spreadsheets/sheet-1?fields=spreadsheetId%2Cproperties.title%2Csheets.properties'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
