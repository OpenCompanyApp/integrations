<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OneDrive;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\OneDrive\OneDriveService;
use OpenCompany\Integrations\OneDrive\OneDriveToolProvider;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveApiGet;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveCreateFolder;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveGetCurrentUser;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveUpdateItem;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Microsoft OneDrive Graph coverage.
 */
final class OneDriveServiceTest extends TestCase
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

    public function test_service_maps_driveitem_sharing_delta_and_generic_endpoints(): void
    {
        Http::fake([
            'https://graph.microsoft.com/v1.0/me/drive/items/item_1/copy' => Http::response('', 202, ['Location' => 'https://monitor.example.test/copy']),
            'https://graph.microsoft.com/v1.0/me/drive/root:/Folder%20Name/report.txt:/content' => Http::response(['id' => 'uploaded'], 200),
            'https://graph.microsoft.com/v1.0/me/drive/items/item_1/content' => Http::response('file-body', 200),
            'https://graph.microsoft.com/v1.0/*' => Http::response(['ok' => true, 'value' => []], 200),
        ]);

        $service = new OneDriveService('graph_test');

        $service->getCurrentUser();
        $service->getDrive();
        $service->listFiles(10, 'skip');
        $service->getFile('item_1');
        $service->listChildren(null, 20);
        $service->listChildren('folder_1', 20);
        $service->createFolder('Reports', null, 'rename');
        $service->updateItem('item_1', ['name' => 'renamed.txt']);
        $service->deleteItem('item_1');
        $service->copyItem('item_1', ['name' => 'copy.txt']);
        $service->uploadFile('Folder Name/report.txt', 'body', 'text/plain');
        $service->downloadFile('item_1');
        $service->listShared(10);
        $service->search('quarterly report');
        $service->delta(['token' => 'abc']);
        $service->listThumbnails('item_1');
        $service->createSharingLink('item_1', ['type' => 'view', 'scope' => 'organization']);
        $service->listPermissions('item_1');
        $service->deletePermission('item_1', 'perm_1');
        $service->apiGet('/me/drive');
        $service->apiPost('/me/drive/root/children', ['name' => 'Reports']);
        $service->apiPatch('/me/drive/items/item_1', ['name' => 'renamed.txt']);
        $service->apiDelete('/me/drive/items/item_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer graph_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://graph.microsoft.com/v1.0/me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://graph.microsoft.com/v1.0/me/drive/root/children?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://graph.microsoft.com/v1.0/me/drive/items/folder_1/children?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive/root/children');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive/items/item_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive/items/item_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive/items/item_1/copy');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive/root:/Folder%20Name/report.txt:/content');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive/items/item_1/content');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === "https://graph.microsoft.com/v1.0/me/drive/root/search(q='quarterly%20report')");
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://graph.microsoft.com/v1.0/me/drive/root/delta?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive/items/item_1/createLink');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive/items/item_1/permissions');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://graph.microsoft.com/v1.0/me/drive/items/item_1/permissions/perm_1');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://graph.microsoft.com/v1.0/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new OneDriveService('graph_test');

        self::assertTrue((new OneDriveCreateFolder($service))->execute([
            'name' => 'Reports',
        ])->succeeded());
        self::assertTrue((new OneDriveUpdateItem($service))->execute([
            'id' => 'item_1',
            'name' => 'renamed.txt',
        ])->succeeded());
        self::assertTrue((new OneDriveApiGet($service))->execute([
            'path' => '/me/drive',
        ])->succeeded());
        self::assertFalse((new OneDriveCreateFolder($service))->execute([])->succeeded());
        self::assertFalse((new OneDriveUpdateItem($service))->execute([
            'id' => 'item_1',
        ])->succeeded());
        self::assertFalse((new OneDriveApiGet($service))->execute([
            'path' => 'https://example.test/me/drive',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://graph.microsoft.com/v1.0/me' => Http::response(['displayName' => 'Example User'], 200),
        ]);

        $provider = new OneDriveToolProvider();
        $tools = $provider->tools();

        self::assertSame('one-drive', $provider->appName());
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('onedrive_get_drive', $tools);
        self::assertArrayHasKey('onedrive_create_folder', $tools);
        self::assertArrayHasKey('onedrive_copy_item', $tools);
        self::assertArrayHasKey('onedrive_create_sharing_link', $tools);
        self::assertArrayHasKey('onedrive_delete_permission', $tools);
        self::assertArrayHasKey('onedrive_api_delete', $tools);
        self::assertSame(22, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'graph_test',
        ])['success']);
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://legacy-graph.example.test/v1.0/me' => Http::response(['displayName' => 'Legacy User'], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'one-drive') {
                    return '';
                }

                if ($integration === 'one_drive' && $account === 'work') {
                    return match ($key) {
                        'access_token' => 'legacy-token',
                        'url' => 'https://legacy-graph.example.test/v1.0',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'one_drive' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'one_drive' ? ['work'] : [];
            }
        });

        $tool = (new OneDriveToolProvider)->createTool(OneDriveGetCurrentUser::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('Legacy User', $result->data['display_name']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy-graph.example.test/v1.0/me'
            && $request->hasHeader('Authorization', 'Bearer legacy-token'));
    }
}
