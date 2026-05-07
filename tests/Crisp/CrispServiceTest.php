<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Crisp;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Crisp\CrispService;
use OpenCompany\Integrations\Crisp\CrispToolProvider;
use OpenCompany\Integrations\Crisp\Tools\CrispGetConversation;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Crisp official REST API operation coverage.
 */
final class CrispServiceTest extends TestCase
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

    public function test_provider_exposes_official_node_crisp_api_surface(): void
    {
        $provider = new CrispToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.crisp.chat/references/rest-api/v1/', $provider->integrationMeta()['docs_url']);
        self::assertCount(226, $tools);
        self::assertArrayHasKey('crisp_list_conversations', $tools);
        self::assertArrayHasKey('crisp_send_message_in_conversation', $tools);
        self::assertArrayHasKey('crisp_get_people_profile', $tools);
        self::assertArrayHasKey('crisp_generate_bucket_url', $tools);
        self::assertArrayHasKey('crisp_generate_analytics', $tools);
        self::assertArrayNotHasKey('crisp_send_message', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], "\\") + 1);
            self::assertFileExists(__DIR__.'/../../packages/crisp/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_default_website_path_query_body_and_crisp_auth(): void
    {
        Http::fake(['*' => Http::response(['error' => false, 'data' => ['ok' => true]], 200)]);

        $service = new CrispService('token-id', 'token-key', 'site-123', 'plugin', 'https://api.example.test/v1');
        $service->call('crisp_list_conversations', ['page_number' => 2, 'query' => ['per_page' => 50]]);
        $service->call('crisp_send_message_in_conversation', [
            'session_id' => 'session_abc',
            'message' => ['type' => 'text', 'from' => 'operator', 'origin' => 'chat', 'content' => 'Hello'],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v1/website/site-123/conversations/2?per_page=50'
            && $request->hasHeader('X-Crisp-Tier', 'plugin')
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('token-id:token-key')));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v1/website/site-123/conversation/session_abc/message'
            && $request->data()['type'] === 'text'
            && $request->data()['content'] === 'Hello');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new CrispGetConversation(new CrispService('token-id', 'token-key'));
        $result = $tool->execute([]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('session_id is required', (string) $result->error);
    }
}
