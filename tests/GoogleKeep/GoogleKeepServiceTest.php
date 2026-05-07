<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleKeep;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleKeep\GoogleKeepService;
use OpenCompany\Integrations\GoogleKeep\GoogleKeepToolProvider;
use OpenCompany\Integrations\GoogleKeep\Tools\GoogleKeepNotesCreate;
use OpenCompany\Integrations\GoogleKeep\Tools\GoogleKeepNotesGet;
use OpenCompany\Integrations\GoogleKeep\Tools\GoogleKeepNotesList;
use PHPUnit\Framework\TestCase;

final class GoogleKeepServiceTest extends TestCase
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

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleKeepToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-keep/google-keep-discovery-manifest.json'), true);

        self::assertSame(7, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Keep', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-keep/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_keep_notes_list', $manifestTools);
        self::assertContains('google_keep_notes_permissions_batch_create', $manifestTools);
        self::assertContains('google_keep_media_download', $manifestTools);
    }

    public function test_service_maps_auth_resource_paths_query_body_and_media_response(): void
    {
        Http::fake(static fn (Request $request) => str_contains($request->url(), '/attachments/')
            ? Http::response('binary-data', 200, ['Content-Type' => 'image/png'])
            : Http::response(['ok' => true], 200));

        $service = new GoogleKeepService('token-test', 'https://example.test');
        $service->request('GET', '/v1/notes', [], [], ['pageSize' => 5]);
        $service->request('POST', '/v1/notes', [], [], [], ['title' => 'Agent checklist']);
        $media = $service->request('GET', '/v1/{+name}', ['name' => 'notes/note-1/attachments/attachment-1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/notes?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/notes'
            && $request['title'] === 'Agent checklist');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/notes/note-1/attachments/attachment-1');
        self::assertSame('binary-data', $media['body']);
        self::assertSame('image/png', $media['content_type']);
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleKeepService('token-test');

        $list = new GoogleKeepNotesList($service);
        $result = $list->execute(['pageSize' => 10, 'filter' => 'trashed = false', 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://keep.googleapis.com/v1/notes?')
                && ($query['pageSize'] ?? null) === '10'
                && ($query['filter'] ?? null) === 'trashed = false';
        });

        $missingPath = (new GoogleKeepNotesGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('name must be', (string) $missingPath->error);

        $missingBody = (new GoogleKeepNotesCreate($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}
