<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GitBook;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\GitBook\GitBookService;
use OpenCompany\Integrations\GitBook\GitBookToolProvider;
use OpenCompany\Integrations\GitBook\Tools\GitBookGetPage;
use OpenCompany\Integrations\GitBook\Tools\GitBookGetPageByPath;
use OpenCompany\Integrations\GitBook\Tools\GitBookListFiles;
use OpenCompany\Integrations\GitBook\Tools\GitBookListOrganizations;
use OpenCompany\Integrations\GitBook\Tools\GitBookListSpaces;
use OpenCompany\Integrations\GitBook\Tools\GitBookSearchSpace;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the GitBook integration.
 */
final class GitBookServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(GitBookService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(GitBookService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new GitBookToolProvider;

        self::assertSame('gitbook', $provider->appName());
        self::assertSame('GitBook', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(13, $provider->tools());
        self::assertContains('gitbook_search_space', array_keys($provider->tools()));
        self::assertContains('gitbook_list_openapi_specs', array_keys($provider->tools()));
    }

    public function test_organization_space_search_and_list_routes_are_mapped(): void
    {
        $service = new GitBookService(token: 'test-token', baseUrl: 'https://gitbook.example.test/v1');

        Http::fake(['*' => Http::response(['items' => [['id' => 'org_123']]], 200)]);
        self::assertTrue((new GitBookListOrganizations($service))->execute(['limit' => 10])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://gitbook.example.test/v1/orgs?')
            && $request->hasHeader('Authorization', 'Bearer test-token')
            && str_contains($request->url(), 'limit=10'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => [['id' => 'space_123']]], 200)]);
        self::assertTrue((new GitBookListSpaces($service))->execute(['organization_id' => 'org_123', 'page' => 'next'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://gitbook.example.test/v1/orgs/org_123/spaces?')
            && str_contains($request->url(), 'page=next'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['results' => []], 200)]);
        self::assertTrue((new GitBookSearchSpace($service))->execute(['space_id' => 'space_123', 'query' => 'auth', 'limit' => 5])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://gitbook.example.test/v1/spaces/space_123/search?')
            && str_contains($request->url(), 'query=auth')
            && str_contains($request->url(), 'limit=5'));
    }

    public function test_page_path_page_id_and_file_routes_are_mapped(): void
    {
        $service = new GitBookService(token: 'test-token', baseUrl: 'https://gitbook.example.test/v1');

        Http::fake(['*' => Http::response(['id' => 'page_123', 'document' => []], 200)]);
        self::assertTrue((new GitBookGetPage($service))->execute(['space_id' => 'space_123', 'page_id' => 'page_123', 'format' => 'markdown'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://gitbook.example.test/v1/spaces/space_123/content/page/page_123?')
            && str_contains($request->url(), 'format=markdown'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['path' => 'developers/api'], 200)]);
        self::assertTrue((new GitBookGetPageByPath($service))->execute(['space_id' => 'space_123', 'page_path' => 'developers/api', 'metadata' => false])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://gitbook.example.test/v1/spaces/space_123/content/path/developers/api?')
            && str_contains($request->url(), 'metadata=0'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => [['id' => 'file_123']]], 200)]);
        self::assertTrue((new GitBookListFiles($service))->execute(['space_id' => 'space_123', 'limit' => 25])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://gitbook.example.test/v1/spaces/space_123/content/files?')
            && str_contains($request->url(), 'limit=25'));
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new GitBookService(token: 'test-token', baseUrl: 'https://gitbook.example.test/v1');

        $missingQuery = (new GitBookSearchSpace($service))->execute(['space_id' => 'space_123']);
        self::assertFalse($missingQuery->succeeded());
        self::assertStringContainsString('query is required', (string) $missingQuery->error);

        $missingPath = (new GitBookGetPageByPath($service))->execute(['space_id' => 'space_123']);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('page_path is required', (string) $missingPath->error);

        Http::fake(['*' => Http::response(['message' => 'Unauthorized'], 401)]);
        $apiError = (new GitBookListOrganizations($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Unauthorized', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'GitBook API token accepted.'], (new GitBookToolProvider)->testConnection(['api_token' => 'test-token']));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $integration === 'gitbook' && $key === 'api_token' && $account === 'docs' ? 'account-token' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'gitbook' && $account === 'docs';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'gitbook' ? ['docs'] : [];
            }
        });

        $tool = (new GitBookToolProvider)->createTool(GitBookListOrganizations::class, ['account' => 'docs']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
