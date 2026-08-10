<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleChat;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleChat\GoogleChatService;
use OpenCompany\Integrations\GoogleChat\GoogleChatToolProvider;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatMediaUpload;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatSpacesGet;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatSpacesMessagesCreate;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatSpacesMessagesList;
use PHPUnit\Framework\TestCase;

final class GoogleChatServiceTest extends TestCase
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
        $provider = new GoogleChatToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-chat/google-chat-discovery-manifest.json'), true);

        self::assertSame(45, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Chat', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('google_chat_spaces_messages_create', array_keys($provider->tools()));
        self::assertContains('google_chat_media_upload', array_keys($provider->tools()));
        self::assertContains('google_chat_users_sections_items_move', array_keys($provider->tools()));
    }

    public function test_service_maps_reserved_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleChatService('token-test', 'https://example.test');
        $service->request('GET', '/v1/{+parent}/messages', ['parent' => 'spaces/AAA'], ['parent'], ['pageSize' => 5]);
        $service->request('POST', '/v1/{+parent}/messages', ['parent' => 'spaces/AAA'], ['parent'], ['threadKey' => 'deploy'], ['text' => 'Done']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/spaces/AAA/messages?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/spaces/AAA/messages?threadKey=deploy'
            && $request['text'] === 'Done');
    }

    public function test_tools_filter_query_require_path_params_body_and_upload_files(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleChatService('token-test');

        $list = new GoogleChatSpacesMessagesList($service);
        $result = $list->execute(['parent' => 'spaces/AAA', 'pageSize' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://chat.googleapis.com/v1/spaces/AAA/messages?pageSize=10');

        $missingPath = (new GoogleChatSpacesGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('name must be', (string) $missingPath->error);

        $missingBody = (new GoogleChatSpacesMessagesCreate($service))->execute(['parent' => 'spaces/AAA']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);

        $file = tempnam(sys_get_temp_dir(), 'chat-upload-');
        file_put_contents((string) $file, 'hello');
        try {
            $upload = (new GoogleChatMediaUpload($service))->execute(['parent' => 'spaces/AAA', 'file_path' => (string) $file, 'mime_type' => 'text/plain', 'body' => ['filename' => 'hello.txt']]);
            self::assertTrue($upload->succeeded());
            Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://chat.googleapis.com/upload/v1/spaces/AAA/attachments:upload?uploadType=multipart'
                && str_starts_with((string) $request->header('Content-Type')[0], 'multipart/related; boundary=')
                && str_contains((string) $request->body(), 'hello.txt')
                && str_contains((string) $request->body(), 'hello'));
        } finally {
            if (is_string($file) && file_exists($file)) unlink($file);
        }
    }
}
