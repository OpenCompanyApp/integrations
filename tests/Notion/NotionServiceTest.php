<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Notion;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\Integrations\Notion\NotionToolProvider;
use OpenCompany\Integrations\Notion\Tools\NotionAppendBlockChildren;
use OpenCompany\Integrations\Notion\Tools\NotionCreatePage;
use OpenCompany\Integrations\Notion\Tools\NotionListUsers;
use OpenCompany\Integrations\Notion\Tools\NotionSearch;
use OpenCompany\Integrations\Notion2\NotionToolProvider as LegacyNotionToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Notion REST API integration.
 */
final class NotionServiceTest extends TestCase
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

    public function test_service_maps_notion_search_page_database_block_user_and_comment_requests(): void
    {
        Http::fake(['https://api.notion.com/v1/*' => Http::response(['object' => 'page', 'results' => []], 200)]);

        $service = new NotionService('secret_test');

        $service->search(['query' => 'Roadmap']);
        $service->createPage(['parent' => ['page_id' => 'page_123']]);
        $service->getPage('page 123');
        $service->updatePage('page 123', ['archived' => true]);
        $service->createDatabase(['parent' => ['page_id' => 'page_123']]);
        $service->getDatabase('database 123');
        $service->updateDatabase('database 123', ['title' => []]);
        $service->queryDatabase('database 123', ['page_size' => 5]);
        $service->getBlockChildren('block 123', ['page_size' => 2]);
        $service->appendBlockChildren('block 123', ['children' => []]);
        $service->getBlock('block 123');
        $service->updateBlock('block 123', ['archived' => true]);
        $service->deleteBlock('block 123');
        $service->getCurrentUser();
        $service->listUsers(['page_size' => 10]);
        $service->getUser('user 123');
        $service->createComment(['parent' => ['page_id' => 'page_123'], 'rich_text' => []]);
        $service->getComments('block 123', ['page_size' => 3]);

        Http::assertSentCount(18);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.notion.com/v1/search'
            && $request->hasHeader('Authorization', 'Bearer secret_test')
            && $request->hasHeader('Notion-Version', '2022-06-28'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.notion.com/v1/pages/page%20123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://api.notion.com/v1/pages/page%20123'
            && $request->data()['archived'] === true);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.notion.com/v1/databases/database%20123/query'
            && $request->data()['page_size'] === 5);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.notion.com/v1/blocks/block%20123/children?page_size=2');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.notion.com/v1/blocks/block%20123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.notion.com/v1/users/me');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.notion.com/v1/comments?page_size=3&block_id=block%20123');
    }

    public function test_provider_metadata_tools_docs_and_legacy_alias(): void
    {
        Http::fake([
            'https://api.notion.com/v1/users/me' => Http::response(['name' => 'Integration Bot'], 200),
        ]);

        $provider = new NotionToolProvider;
        $tools = $provider->tools();
        $composer = json_decode((string) file_get_contents(__DIR__.'/../../packages/notion/composer.json'), true);
        $legacyProvider = new LegacyNotionToolProvider;

        self::assertSame('notion', $provider->appName());
        self::assertSame('Notion', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.notion.com', $provider->integrationMeta()['docs_url']);
        self::assertSame('self.version', $composer['replace']['opencompanyapp/integration-notion2'] ?? null);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(20, $tools);
        self::assertArrayHasKey('notion_search', $tools);
        self::assertArrayHasKey('notion_create_comment', $tools);
        self::assertArrayHasKey('notion_get_block_children', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }

        self::assertTrue($provider->testConnection(['api_key' => 'secret_test'])['success']);
        self::assertSame('notion', $legacyProvider->appName());
        self::assertCount(20, $legacyProvider->tools());
    }

    public function test_tools_validate_arguments_and_multi_account_resolution_supports_legacy_credentials(): void
    {
        Http::fake([
            'https://api.notion.com/v1/search' => Http::response(['results' => [['id' => 'page_123', 'object' => 'page', 'url' => 'https://notion.example.test/page']]], 200),
            'https://api.notion.com/v1/users?page_size=2' => Http::response(['results' => []], 200),
        ]);

        $service = new NotionService('secret_test');

        self::assertTrue((new NotionSearch($service))->execute(['query' => 'Roadmap'])->succeeded());
        self::assertFalse((new NotionCreatePage($service))->execute(['parent_id' => 'page_123'])->succeeded());
        self::assertFalse((new NotionAppendBlockChildren($service))->execute([
            'block_id' => 'block_123',
            'children' => '{bad json',
        ])->succeeded());

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'notion') {
                    return '';
                }

                return $key === 'access_token' && $account === 'workspace' ? 'legacy-notion-token' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['workspace'];
            }
        });

        $tool = (new NotionToolProvider)->createTool(NotionListUsers::class, ['account' => 'workspace']);

        self::assertTrue($tool->execute(['page_size' => 2])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.notion.com/v1/users?page_size=2'
            && $request->hasHeader('Authorization', 'Bearer legacy-notion-token'));
    }
}
