<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Box;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\Integrations\Box\BoxToolProvider;
use OpenCompany\Integrations\Box\Tools\BoxGetFilesId;
use OpenCompany\Integrations\Box\Tools\BoxGetFilesIdContent;
use OpenCompany\Integrations\Box\Tools\BoxGetFoldersIdItems;
use OpenCompany\Integrations\Box\Tools\BoxGetSearch;
use OpenCompany\Integrations\Box\Tools\BoxGetUsersMe;
use OpenCompany\Integrations\Box\Tools\BoxPostFilesContent;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Box official OpenAPI operation coverage.
 */
final class BoxServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BoxService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BoxService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_official_openapi_surface(): void
    {
        $provider = new BoxToolProvider;
        $tools = $provider->tools();

        self::assertSame('box', $provider->appName());
        self::assertSame('Box', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://raw.githubusercontent.com/box/box-openapi/main/openapi.json', $provider->integrationMeta()['source_url']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('access_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(294, $tools);
        self::assertArrayHasKey('box_get_files_id', $tools);
        self::assertArrayHasKey('box_get_folders_id_items', $tools);
        self::assertArrayHasKey('box_post_files_content', $tools);
        self::assertArrayHasKey('box_get_search', $tools);
        self::assertArrayNotHasKey('box_list_files', $tools);
    }

    public function test_service_maps_path_query_json_download_and_upload_hosts(): void
    {
        $service = new BoxService(
            accessToken: 'token-123',
            baseUrl: 'https://api.example.test/2.0',
            uploadUrl: 'https://upload.example.test/api/2.0',
        );

        Http::fake(['*' => Http::response(['id' => '12345', 'type' => 'file'], 200)]);
        self::assertTrue((new BoxGetFilesId($service))->execute([
            'file_id' => '12345',
            'fields' => 'id,type,name',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/2.0/files/12345?fields=id%2Ctype%2Cname'
            && $request->hasHeader('Authorization', 'Bearer token-123'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['entries' => []], 200)]);
        self::assertTrue((new BoxGetFoldersIdItems($service))->execute([
            'folder_id' => '0',
            'limit' => 50,
            'offset' => 10,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/2.0/folders/0/items?')
            && str_contains($request->url(), 'limit=50')
            && str_contains($request->url(), 'offset=10'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('file bytes', 200, ['Content-Type' => 'application/octet-stream'])]);
        $download = (new BoxGetFilesIdContent($service))->execute(['file_id' => '12345']);
        self::assertTrue($download->succeeded());
        self::assertSame('file bytes', $download->data['body']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/2.0/files/12345/content');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['entries' => [['id' => 'upload_123']]], 201)]);
        self::assertTrue((new BoxPostFilesContent($service))->execute([
            'body' => [
                'attributes' => '{"name":"notes.txt","parent":{"id":"0"}}',
                'file' => 'hello',
            ],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://upload.example.test/api/2.0/files/content'
            && $request->hasHeader('Authorization', 'Bearer token-123'));
    }

    public function test_validation_errors_test_connection_and_multi_account(): void
    {
        $service = new BoxService('token-123', 'https://api.example.test/2.0');

        $missingPath = (new BoxGetFilesId($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('file_id is required', (string) $missingPath->error);

        $missingBody = (new BoxPostFilesContent($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body is required', (string) $missingBody->error);

        $unconfigured = (new BoxGetSearch(new BoxService))->execute(['query' => 'report']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['message' => 'Invalid token'], 401)]);
        $apiError = (new BoxGetUsersMe($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid token', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['name' => 'Example User', 'login' => 'user@example.test'], 200)]);
        self::assertSame(
            ['success' => true, 'message' => 'Connected to Box as Example User (user@example.test).'],
            (new BoxToolProvider)->testConnection([
                'access_token' => 'token-123',
                'url' => 'https://api.example.test/2.0',
            ]),
        );
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/2.0/users/me'
            && $request->hasHeader('Authorization', 'Bearer token-123'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['entries' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['box', 'access_token', 'workspace'] => 'account-token',
                    ['box', 'url', 'workspace'] => 'https://account-api.example.test/2.0',
                    ['box', 'upload_url', 'workspace'] => 'https://account-upload.example.test/api/2.0',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'box' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'box' ? ['workspace'] : [];
            }
        });

        $tool = (new BoxToolProvider)->createTool(BoxGetFoldersIdItems::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute(['folder_id' => '0', 'limit' => 5])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://account-api.example.test/2.0/folders/0/items?')
            && $request->hasHeader('Authorization', 'Bearer account-token')
            && str_contains($request->url(), 'limit=5'));
    }
}
