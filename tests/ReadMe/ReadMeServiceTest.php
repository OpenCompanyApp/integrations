<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ReadMe;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ReadMe\ReadMeService;
use OpenCompany\Integrations\ReadMe\ReadMeToolProvider;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetApiDefinition;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetBranch;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetCategory;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetGuide;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetProjectMetadata;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetReference;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListApiDefinitions;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListApiKeys;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListBranches;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListCategories;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListCategoryPages;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeSearchDocs;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the ReadMe integration.
 */
final class ReadMeServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ReadMeService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ReadMeService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new ReadMeToolProvider;

        self::assertSame('readme', $provider->appName());
        self::assertSame('ReadMe', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(12, $provider->tools());
        self::assertContains('readme_list_branches', array_keys($provider->tools()));
        self::assertContains('readme_search_docs', array_keys($provider->tools()));
    }

    public function test_project_api_key_branch_and_api_definition_routes_are_mapped(): void
    {
        $service = new ReadMeService(apiToken: 'test-token', baseUrl: 'https://readme.example.test/v2');

        Http::fake(['*' => Http::response(['subdomain' => 'example'], 200)]);
        self::assertTrue((new ReadMeGetProjectMetadata($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://readme.example.test/v2/project'
            && $request->hasHeader('Authorization', 'Bearer test-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['name' => 'production']]], 200)]);
        self::assertTrue((new ReadMeListApiKeys($service))->execute(['subdomain' => 'example-docs', 'page' => 2])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://readme.example.test/v2/projects/example-docs/apikeys?')
            && str_contains($request->url(), 'page=2'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['name' => 'stable']]], 200)]);
        self::assertTrue((new ReadMeListBranches($service))->execute(['per_page' => 10])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://readme.example.test/v2/branches?')
            && str_contains($request->url(), 'per_page=10'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['name' => 'stable'], 200)]);
        self::assertTrue((new ReadMeGetBranch($service))->execute(['branch' => 'stable'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://readme.example.test/v2/branches/stable');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'api_123']]], 200)]);
        self::assertTrue((new ReadMeListApiDefinitions($service))->execute(['page' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://readme.example.test/v2/apis?')
            && str_contains($request->url(), 'page=1'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'api_123'], 200)]);
        self::assertTrue((new ReadMeGetApiDefinition($service))->execute(['api_id' => 'api_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://readme.example.test/v2/apis/api_123');
    }

    public function test_category_page_guide_reference_and_search_routes_are_mapped(): void
    {
        $service = new ReadMeService(
            apiToken: 'test-token',
            baseUrl: 'https://readme.example.test/v2',
            legacyBaseUrl: 'https://legacy-readme.example.test/api/v1',
        );

        Http::fake(['*' => Http::response(['data' => [['title' => 'Getting Started']]], 200)]);
        self::assertTrue((new ReadMeListCategories($service))->execute(['branch' => 'stable', 'section' => 'guides'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://readme.example.test/v2/branches/stable/categories/guides');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['title' => 'Getting Started'], 200)]);
        self::assertTrue((new ReadMeGetCategory($service))->execute(['branch' => 'stable', 'section' => 'guides', 'title' => 'Getting Started'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://readme.example.test/v2/branches/stable/categories/guides/Getting%20Started');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['slug' => 'intro']]], 200)]);
        self::assertTrue((new ReadMeListCategoryPages($service))->execute(['branch' => 'stable', 'section' => 'guides', 'title' => 'Getting Started', 'per_page' => 25])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://readme.example.test/v2/branches/stable/categories/guides/Getting%20Started/pages?')
            && str_contains($request->url(), 'per_page=25'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['slug' => 'auth'], 200)]);
        self::assertTrue((new ReadMeGetGuide($service))->execute(['branch' => 'stable', 'slug' => 'auth'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://readme.example.test/v2/branches/stable/guides/auth');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['slug' => 'create-user'], 200)]);
        self::assertTrue((new ReadMeGetReference($service))->execute(['branch' => 'stable', 'slug' => 'create-user'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://readme.example.test/v2/branches/stable/references/create-user');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['results' => [['title' => 'Webhooks']]], 200)]);
        self::assertTrue((new ReadMeSearchDocs($service))->execute(['search' => 'webhooks', 'version' => 'v1.0'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://legacy-readme.example.test/api/v1/docs/search'
            && $request->hasHeader('x-readme-version', 'v1.0')
            && $request->data() === ['search' => 'webhooks']);
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new ReadMeService(apiToken: 'test-token', baseUrl: 'https://readme.example.test/v2');

        $missingBranch = (new ReadMeGetBranch($service))->execute([]);
        self::assertFalse($missingBranch->succeeded());
        self::assertStringContainsString('branch is required', (string) $missingBranch->error);

        $unsupportedSection = (new ReadMeListCategories($service))->execute(['branch' => 'stable', 'section' => 'changelog']);
        self::assertFalse($unsupportedSection->succeeded());
        self::assertStringContainsString('section must be guides', (string) $unsupportedSection->error);

        $missingToken = (new ReadMeGetProjectMetadata(new ReadMeService))->execute([]);
        self::assertFalse($missingToken->succeeded());
        self::assertStringContainsString('ReadMe API token is required', (string) $missingToken->error);

        Http::fake(['*' => Http::response(['message' => 'Unauthorized'], 401)]);
        $apiError = (new ReadMeListBranches($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Unauthorized', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'ReadMe API token accepted.'], (new ReadMeToolProvider)->testConnection(['api_token' => 'test-token']));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $integration === 'readme' && $key === 'api_token' && $account === 'docs' ? 'account-token' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'readme' && $account === 'docs';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'readme' ? ['docs'] : [];
            }
        });

        $tool = (new ReadMeToolProvider)->createTool(ReadMeListBranches::class, ['account' => 'docs']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
