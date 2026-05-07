<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Readwise;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Readwise\ReadwiseService;
use OpenCompany\Integrations\Readwise\ReadwiseToolProvider;
use OpenCompany\Integrations\Readwise\Tools\ReadwiseApiGet;
use OpenCompany\Integrations\Readwise\Tools\ReadwiseListDocuments;
use OpenCompany\Integrations\Readwise\Tools\ReadwiseSaveDocument;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Readwise v2 and Reader v3 APIs.
 */
final class ReadwiseServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ReadwiseService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ReadwiseService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new ReadwiseToolProvider();

        self::assertSame('readwise', $provider->appName());
        self::assertSame('Readwise', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(26, $provider->tools());
        self::assertCount(22, ReadwiseService::operations());
        self::assertArrayHasKey('readwise_export_highlights', $provider->tools());
        self::assertArrayHasKey('readwise_save_document', $provider->tools());
        self::assertArrayHasKey('readwise_bulk_update_documents', $provider->tools());
        self::assertArrayHasKey('readwise_api_get', $provider->tools());
    }

    public function test_service_maps_documented_readwise_api_endpoints(): void
    {
        Http::fake([
            'https://readwise.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new ReadwiseService('rw-token', 'https://readwise.test');
        $service->call('check_auth');
        $service->call('list_books', ['page' => 2]);
        $service->call('get_book', ['book_id' => '1776']);
        $service->call('list_book_tags', ['book_id' => '1776']);
        $service->call('create_book_tag', ['book_id' => '1776', 'name' => 'research']);
        $service->call('delete_book_tag', ['book_id' => '1776', 'tag_id' => '42']);
        $service->call('list_highlights', ['page' => 3]);
        $service->call('create_highlights', ['highlights' => [['text' => 'Important', 'title' => 'Book']]]);
        $service->call('update_highlight', ['highlight_id' => '13', 'text' => 'Updated']);
        $service->call('export_highlights', ['updatedAfter' => '2026-05-01T00:00:00Z']);
        $service->call('list_documents', ['location' => 'archive']);
        $service->call('save_document', ['url' => 'https://example.test/article']);
        $service->call('update_document', ['document_id' => 'doc-1', 'title' => 'Updated']);
        $service->call('bulk_update_documents', ['updates' => [['id' => 'doc-1', 'location' => 'archive']]]);
        $service->call('delete_document', ['document_id' => 'doc-1']);
        $service->call('list_reader_tags');
        $service->apiGet('/api/v3/list/', ['limit' => 10]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Token rw-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://readwise.test/api/v2/auth/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://readwise.test/api/v2/books/?page=2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://readwise.test/api/v2/books/1776/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://readwise.test/api/v2/books/1776/tags');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://readwise.test/api/v2/books/1776/tags' && $request->data()['name'] === 'research');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://readwise.test/api/v2/books/1776/tags/42');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://readwise.test/api/v2/highlights/?page=3');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://readwise.test/api/v2/highlights/' && $request->data()['highlights'][0]['text'] === 'Important');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://readwise.test/api/v2/highlights/13/' && $request->data()['text'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'https://readwise.test/api/v2/export/?updatedAfter='));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://readwise.test/api/v3/list/?location=archive');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://readwise.test/api/v3/save/' && $request->data()['url'] === 'https://example.test/article');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://readwise.test/api/v3/update/doc-1/' && $request->data()['title'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://readwise.test/api/v3/bulk_update/' && $request->data()['updates'][0]['id'] === 'doc-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://readwise.test/api/v3/delete/doc-1/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://readwise.test/api/v3/tags/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://readwise.test/api/v3/list/?limit=10');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://readwise.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new ReadwiseService('rw-token', 'https://readwise.test');

        self::assertTrue((new ReadwiseListDocuments($service))->execute(['location' => 'archive'])->succeeded());
        self::assertTrue((new ReadwiseSaveDocument($service))->execute([
            'url' => 'https://example.test/article',
            'payload' => ['tags' => ['research']],
        ])->succeeded());

        $badRaw = (new ReadwiseApiGet($service))->execute(['path' => 'https://evil.example.test/api/v3/list/']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new ReadwiseApiGet(new ReadwiseService('', 'https://readwise.test')))->execute(['path' => '/api/v3/list/']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new ReadwiseToolProvider();

        self::assertSame(['success' => false, 'error' => 'Readwise access token is required.'], $provider->testConnection([]));

        Http::fake(['https://readwise.io/api/v2/auth/' => Http::response('', 204)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Readwise API.'], $provider->testConnection([
            'access_token' => 'rw-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.readwise.test/api/v3/list/' => Http::response(['results' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['readwise', 'access_token', 'ops'] => 'account-token',
                    ['readwise', 'url', 'ops'] => 'https://ops.readwise.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'readwise' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'readwise' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(ReadwiseListDocuments::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.readwise.test/api/v3/list/'
            && $request->hasHeader('Authorization', 'Token account-token'));
    }
}
