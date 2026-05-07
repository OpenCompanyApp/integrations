<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftExcel;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftExcel\MicrosoftExcelService;
use OpenCompany\Integrations\MicrosoftExcel\MicrosoftExcelToolProvider;
use OpenCompany\Integrations\MicrosoftExcel\Tools\MicrosoftExcelDrivesDriveItemsDriveItemWorkbookCreateSession;
use OpenCompany\Integrations\MicrosoftExcel\Tools\MicrosoftExcelDrivesItemsGetWorkbook;
use OpenCompany\Integrations\MicrosoftExcel\Tools\MicrosoftExcelDrivesItemsWorkbookListWorksheets;
use OpenCompany\Integrations\MicrosoftExcel\Tools\MicrosoftExcelDrivesItemsWorkbookWorksheetsRangeUpdateFormatB0fa;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Excel integration.
 */
final class MicrosoftExcelServiceTest extends TestCase
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
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new MicrosoftExcelToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-excel/microsoft-excel-openapi-manifest.json'), true);

        self::assertSame(1765, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertSame('paths containing /workbook from Microsoft Graph v1.0', $manifest['path_match']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Excel', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('microsoft_excel_drives_items_get_workbook', array_keys($provider->tools()));
        self::assertContains('microsoft_excel_drives_items_workbook_list_worksheets', array_keys($provider->tools()));
        self::assertContains('microsoft_excel_drives_drive_items_drive_item_workbook_create_session', array_keys($provider->tools()));
        self::assertContains('microsoft_excel_drives_items_workbook_worksheets_range_update_format_b0fa', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_workbook_headers_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftExcelService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/drives/{drive-id}/items/{driveItem-id}/workbook', ['drive-id' => 'drive 1', 'driveItem-id' => 'item 1'], ['$select' => 'id,name']);
        $service->request(
            'PATCH',
            '/drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/range(address=\'{address}\')/format',
            ['drive-id' => 'drive 1', 'driveItem-id' => 'item 1', 'workbookWorksheet-id' => 'sheet 1', 'address' => 'Sheet1!A1:D10'],
            [],
            ['Workbook-Session-Id' => 'session-123', 'Prefer' => 'respond-async'],
            ['columnWidth' => 18],
        );

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/drives/drive%201/items/item%201/workbook?%24select=id%2Cname'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === "https://graph.example.test/v1.0/drives/drive%201/items/item%201/workbook/worksheets/sheet%201/range(address='Sheet1%21A1%3AD10')/format"
            && $request->hasHeader('Workbook-Session-Id', 'session-123')
            && $request->hasHeader('Prefer', 'respond-async')
            && $request->data()['columnWidth'] === 18);
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftExcelService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftExcelDrivesItemsGetWorkbook($service))->execute(['drive_id' => 'drive-123', 'drive_item_id' => 'item-123', 'select' => 'id,name'])->succeeded());
        self::assertTrue((new MicrosoftExcelDrivesItemsWorkbookListWorksheets($service))->execute(['drive_id' => 'drive-123', 'drive_item_id' => 'item-123', 'top' => 5])->succeeded());
        self::assertTrue((new MicrosoftExcelDrivesDriveItemsDriveItemWorkbookCreateSession($service))->execute(['drive_id' => 'drive-123', 'drive_item_id' => 'item-123', 'body' => ['persistChanges' => true]])->succeeded());
        self::assertTrue((new MicrosoftExcelDrivesItemsWorkbookWorksheetsRangeUpdateFormatB0fa($service))->execute(['drive_id' => 'drive-123', 'drive_item_id' => 'item-123', 'workbook_worksheet_id' => 'sheet-123', 'address' => 'A1:D10', 'workbook_session_id' => 'session-123', 'body' => ['horizontalAlignment' => 'Center']])->succeeded());

        $missingPath = (new MicrosoftExcelDrivesItemsGetWorkbook($service))->execute(['drive_id' => 'drive-123']);
        $badBody = (new MicrosoftExcelDrivesDriveItemsDriveItemWorkbookCreateSession($service))->execute(['drive_id' => 'drive-123', 'drive_item_id' => 'item-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftExcelDrivesDriveItemsDriveItemWorkbookCreateSession($service))->execute(['drive_id' => 'drive-123', 'drive_item_id' => 'item-123']);
        $unconfigured = (new MicrosoftExcelDrivesItemsGetWorkbook(new MicrosoftExcelService('', 'https://graph.example.test/v1.0')))->execute(['drive_id' => 'drive-123', 'drive_item_id' => 'item-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('drive_item_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_drive_root_probe(): void
    {
        Http::fake(['graph.example.test/v1.0/me/drive/root' => Http::response(['id' => 'root'], 200)]);

        $result = (new MicrosoftExcelToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/drive/root'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            /** @var list<string> */
            public array $seenIntegrations = [];

            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $this->seenIntegrations[] = $integration;

                $values = [
                    'access_token' => $account === 'work' ? 'work-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $resolver = Container::getInstance()->make(CredentialResolver::class);
        $tool = (new MicrosoftExcelToolProvider)->createTool(MicrosoftExcelDrivesItemsGetWorkbook::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['drive_id' => 'drive-123', 'drive_item_id' => 'item-123'])->succeeded());

        self::assertSame(['microsoft-excel', 'microsoft-excel'], $resolver->seenIntegrations);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
