<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Dropbox;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\Integrations\Dropbox\DropboxToolProvider;
use OpenCompany\Integrations\Dropbox\Tools\DropboxDownloadFile;
use OpenCompany\Integrations\Dropbox\Tools\DropboxListFolder;
use OpenCompany\Integrations\Dropbox\Tools\DropboxSearchFiles;
use OpenCompany\Integrations\Dropbox\Tools\DropboxUploadFile;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Dropbox API v2 integration.
 */
final class DropboxServiceTest extends TestCase
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

    public function test_provider_metadata_credentials_tools_and_docs(): void
    {
        $provider = new DropboxToolProvider;
        $tools = $provider->tools();

        self::assertSame('dropbox', $provider->appName());
        self::assertSame('Dropbox', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://www.dropbox.com/developers/documentation/http/documentation', $provider->integrationMeta()['docs_url']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(17, $tools);
        self::assertArrayHasKey('dropbox_upload_file', $tools);
        self::assertArrayHasKey('dropbox_download_file', $tools);
        self::assertArrayHasKey('dropbox_get_current_account', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_rpc_content_download_and_account_requests(): void
    {
        Http::fake([
            'https://content.dropboxapi.com/2/files/download' => Http::response('raw file contents', 200),
            '*' => Http::response(['ok' => true, 'account_id' => 'dbid:123'], 200),
        ]);

        $service = new DropboxService('sl.test-token');

        $service->listFolder(['path' => '/Docs', 'recursive' => true, 'limit' => 10]);
        $service->listFolderContinue(['cursor' => 'cursor_123']);
        $service->uploadFile(['path' => '/Docs/report.txt', 'mode' => 'overwrite', 'autorename' => true], 'hello');
        self::assertSame('raw file contents', $service->downloadFile(['path' => '/Docs/report.txt']));
        $service->createFolder(['path' => '/Docs/New', 'autorename' => true]);
        $service->delete(['path' => '/Docs/old.txt']);
        $service->move(['from_path' => '/Docs/a.txt', 'to_path' => '/Docs/b.txt']);
        $service->copy(['from_path' => '/Docs/a.txt', 'to_path' => '/Docs/c.txt']);
        $service->searchFiles(['query' => 'report', 'options' => ['path' => '/Docs']]);
        $service->searchContinue(['cursor' => 'search_cursor']);
        $service->createSharedLink(['path' => '/Docs/report.txt']);
        $service->listSharedLinks(['path' => '/Docs/report.txt']);
        $service->getTemporaryLink(['path' => '/Docs/report.txt']);
        $service->listRevisions(['path' => '/Docs/report.txt', 'limit' => 5]);
        $service->restore(['path' => '/Docs/report.txt', 'rev' => 'rev_123']);
        $service->getMetadata(['path' => '/Docs/report.txt']);
        $service->getCurrentAccount();

        Http::assertSentCount(17);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.dropboxapi.com/2/files/list_folder'
            && $request->hasHeader('Authorization', 'Bearer sl.test-token')
            && $request->hasHeader('Content-Type', 'application/json')
            && $request->data()['path'] === '/Docs'
            && $request->data()['recursive'] === true);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://content.dropboxapi.com/2/files/upload'
            && $request->hasHeader('Dropbox-API-Arg', '{"path":"/Docs/report.txt","mode":"overwrite","autorename":true}')
            && $request->body() === 'hello');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://content.dropboxapi.com/2/files/download'
            && $request->hasHeader('Dropbox-API-Arg', '{"path":"/Docs/report.txt"}'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.dropboxapi.com/2/files/move_v2'
            && $request->data()['from_path'] === '/Docs/a.txt'
            && $request->data()['to_path'] === '/Docs/b.txt');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.dropboxapi.com/2/files/search_v2'
            && $request->data()['query'] === 'report'
            && $request->data()['options']['path'] === '/Docs');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.dropboxapi.com/2/users/get_current_account');
    }

    public function test_service_throws_normalized_dropbox_errors(): void
    {
        Http::fake([
            'https://api.dropboxapi.com/2/files/list_folder' => Http::response([
                'error_summary' => 'path/not_found/...',
            ], 409),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Dropbox API error (409): path/not_found/...');

        (new DropboxService('sl.test-token'))->listFolder(['path' => '/Missing']);
    }

    public function test_tools_validate_configuration_and_map_agent_parameters(): void
    {
        Http::fake([
            'https://content.dropboxapi.com/2/files/upload' => Http::response(['path_display' => '/Docs/report.txt'], 200),
            'https://content.dropboxapi.com/2/files/download' => Http::response('raw file contents', 200),
            'https://api.dropboxapi.com/2/files/search_v2' => Http::response(['matches' => []], 200),
        ]);

        $service = new DropboxService('sl.test-token');

        $uploaded = (new DropboxUploadFile($service))->execute([
            'path' => '/Docs/report.txt',
            'content' => 'hello',
            'mode' => 'overwrite',
            'autorename' => true,
            'mute' => true,
        ]);
        $downloaded = (new DropboxDownloadFile($service))->execute(['path' => '/Docs/report.txt']);
        $searched = (new DropboxSearchFiles($service))->execute([
            'query' => 'report',
            'path' => '/Docs',
            'file_categories' => ['document'],
            'max_results' => 10,
        ]);
        $missingQuery = (new DropboxSearchFiles($service))->execute([]);
        $unconfigured = (new DropboxListFolder(new DropboxService('')))->execute([]);

        self::assertTrue($uploaded->succeeded());
        self::assertTrue($downloaded->succeeded());
        self::assertSame('raw file contents', $downloaded->data);
        self::assertTrue($searched->succeeded());
        self::assertFalse($missingQuery->succeeded());
        self::assertStringContainsString('search query is required', (string) $missingQuery->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('Missing access token', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://content.dropboxapi.com/2/files/upload'
            && $request->hasHeader('Dropbox-API-Arg', '{"path":"/Docs/report.txt","mode":"overwrite","autorename":true,"mute":true}')
            && $request->body() === 'hello');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.dropboxapi.com/2/files/search_v2'
            && $request->data()['options']['file_categories'][0] === 'document'
            && $request->data()['options']['max_results'] === 10);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new DropboxToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://api.dropboxapi.com/2/users/get_current_account' => Http::response([
                'name' => ['display_name' => 'Agent User'],
                'email' => 'agent@example.test',
            ], 200),
            'https://api.dropboxapi.com/2/files/list_folder' => Http::response(['entries' => []], 200),
        ]);

        $result = $provider->testConnection(['access_token' => 'sl.test-token']);

        self::assertTrue($result['success']);
        self::assertStringContainsString('Agent User', (string) $result['message']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $key === 'access_token' && $account === 'work' ? 'sl.work-token' : $default;
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

        $tool = $provider->createTool(DropboxListFolder::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['path' => '/Docs'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.dropboxapi.com/2/users/get_current_account'
            && $request->hasHeader('Authorization', 'Bearer sl.test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.dropboxapi.com/2/files/list_folder'
            && $request->hasHeader('Authorization', 'Bearer sl.work-token')
            && $request->data()['path'] === '/Docs');
    }
}
