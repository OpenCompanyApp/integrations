<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Shortcut;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Shortcut\ShortcutService;
use OpenCompany\Integrations\Shortcut\ShortcutToolProvider;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateStory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetStory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListCategories;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Shortcut REST API integration.
 */
final class ShortcutServiceTest extends TestCase
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

    public function test_provider_matches_swagger_manifest_and_docs(): void
    {
        $provider = new ShortcutToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/shortcut/shortcut-openapi-manifest.json'), true);

        self::assertSame(144, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Shortcut', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('shortcut_list_categories', array_keys($provider->tools()));
        self::assertContains('shortcut_create_story', array_keys($provider->tools()));
        self::assertContains('shortcut_upload_files', array_keys($provider->tools()));
    }

    public function test_service_maps_token_path_query_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ShortcutService('key', 'https://shortcut.example.test');
        $service->request('GET', '/api/v3/categories', [], ['page_size' => 10]);
        $service->request('POST', '/api/v3/stories', [], [], [], ['name' => 'Story']);
        $service->request('GET', '/api/v3/stories/{story-public-id}', ['story-public-id' => 'story 1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shortcut.example.test/api/v3/categories?page_size=10'
            && $request->hasHeader('Shortcut-Token', 'key'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shortcut.example.test/api/v3/stories'
            && $request['name'] === 'Story');

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://shortcut.example.test/api/v3/stories/story%201');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ShortcutService('key', 'https://shortcut.example.test');
        $list = (new ShortcutListCategories($service))->execute([]);
        self::assertTrue($list->succeeded());

        $missing = (new ShortcutGetStory($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('story_public_id must be', (string) $missing->error);

        $created = (new ShortcutCreateStory($service))->execute(['body' => ['name' => 'Story']]);
        self::assertTrue($created->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://shortcut.example.test/api/v3/stories');
    }
}
