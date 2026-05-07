<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Devin;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\Integrations\Devin\DevinToolProvider;
use OpenCompany\Integrations\Devin\Tools\DevinAppendSessionTags;
use OpenCompany\Integrations\Devin\Tools\DevinCreateSecret;
use OpenCompany\Integrations\Devin\Tools\DevinCreateSession;
use OpenCompany\Integrations\Devin\Tools\DevinListSessionMessages;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Devin v3 endpoint mappings and legacy v1 compatibility.
 */
final class DevinServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_session_secret_and_self_calls_to_current_v3_api(): void
    {
        Http::fake([
            'https://api.devin.ai/v3/self' => Http::response(['id' => 'svc_example'], 200),
            'https://api.devin.ai/v3/organizations/org_example/sessions*' => Http::response(['session_id' => 'devin_123', 'items' => []], 200),
            'https://api.devin.ai/v3/organizations/org_example/sessions/devin-123*' => Http::response(['session_id' => 'devin-123'], 200),
            'https://api.devin.ai/v3/organizations/org_example/secrets*' => Http::response(['secret_id' => 'secret_example', 'items' => []], 200),
        ]);

        $service = new DevinService('cog_test', 'https://api.devin.ai/v3', 'org_example');

        $service->getCurrentUser();
        $service->createSession('Fix the example.test queue job', [
            'title' => 'Queue job fix',
            'tags' => ['queue'],
            'repos' => ['example/example-app'],
            'create_as_user_id' => 'user_example',
        ]);
        $service->listSessions(['first' => 10, 'tags' => ['queue'], 'origins' => ['api']]);
        $service->getSession('devin-123');
        $service->sendMessage('devin-123', 'Start with the failing test.', 'user_example');
        $service->terminateSession('devin-123', true);
        $service->listSessionMessages('devin-123', ['first' => 25]);
        $service->listSessionAttachments('devin-123');
        $service->getSessionTags('devin-123');
        $service->appendSessionTags('devin-123', ['reviewed']);
        $service->getSessionInsights('devin-123');
        $service->generateSessionInsights('devin-123');
        $service->listSecrets(['first' => 20]);
        $service->createSecret([
            'type' => 'key-value',
            'key' => 'EXAMPLE_TOKEN',
            'value' => 'dummy-value',
            'is_sensitive' => true,
        ]);
        $service->deleteSecret('secret_example');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer cog_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.devin.ai/v3/self');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/sessions' && $request['prompt'] === 'Fix the example.test queue job' && $request['create_as_user_id'] === 'user_example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.devin.ai/v3/organizations/org_example/sessions?') && str_contains($request->url(), 'first=10'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/sessions/devin-123/messages' && $request['message_as_user_id'] === 'user_example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/sessions/devin-123?archive=true');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/sessions/devin-123/tags' && $request['tags'] === ['reviewed']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/sessions/devin-123/insights/generate');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/secrets' && $request['is_sensitive'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/secrets/secret_example');
    }

    public function test_tools_map_agent_arguments_to_v3_payloads(): void
    {
        Http::fake([
            'https://api.devin.ai/v3/organizations/org_example/sessions*' => Http::response(['session_id' => 'devin-123'], 200),
            'https://api.devin.ai/v3/organizations/org_example/secrets' => Http::response(['secret_id' => 'secret_example'], 200),
        ]);

        $service = new DevinService('cog_test', 'https://api.devin.ai', 'org_example');

        self::assertNull((new DevinCreateSession($service))->execute([
            'prompt' => 'Document the example.test deploy flow',
            'tags' => ['docs'],
            'repos' => ['example/example-app'],
        ])->error);

        self::assertNull((new DevinListSessionMessages($service))->execute([
            'session_id' => 'devin-123',
            'first' => 5,
        ])->error);

        self::assertNull((new DevinAppendSessionTags($service))->execute([
            'session_id' => 'devin-123',
            'tags' => ['done'],
        ])->error);

        self::assertNull((new DevinCreateSecret($service))->execute([
            'type' => 'key-value',
            'key' => 'EXAMPLE_TOKEN',
            'value' => 'dummy-value',
            'is_sensitive' => true,
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/sessions' && $request['repos'] === ['example/example-app']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.devin.ai/v3/organizations/org_example/sessions/devin-123/messages?') && str_contains($request->url(), 'first=5'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/sessions/devin-123/tags' && $request['tags'] === ['done']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v3/organizations/org_example/secrets' && $request['type'] === 'key-value');
    }

    public function test_legacy_v1_url_keeps_legacy_session_endpoints(): void
    {
        Http::fake([
            'https://api.devin.ai/v1/sessions*' => Http::response(['session_id' => 'session_123', 'sessions' => []], 200),
            'https://api.devin.ai/v1/sessions/session_123*' => Http::response(['detail' => 'ok'], 200),
        ]);

        $service = new DevinService('apk_test', 'https://api.devin.ai/v1');

        $service->createSession('Fix the example.test failing specs', ['idempotent' => true, 'tags' => ['tests']]);
        $service->listSessions(['limit' => 5, 'tags' => ['tests']]);
        $service->sendMessage('session_123', 'Please continue.');
        $service->appendSessionTags('session_123', ['tests']);
        $service->terminateSession('session_123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v1/sessions' && $request['idempotent'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.devin.ai/v1/sessions?') && str_contains($request->url(), 'limit=5'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.devin.ai/v1/sessions/session_123/message' && $request['message'] === 'Please continue.');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.devin.ai/v1/sessions/session_123/tags');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.devin.ai/v1/sessions/session_123');
    }

    public function test_provider_exposes_current_metadata_and_tool_catalog(): void
    {
        Http::fake([
            'https://api.devin.ai/v3/organizations/org_example/sessions*' => Http::response(['items' => []], 200),
            'https://api.devin.ai/v3/self' => Http::response(['id' => 'svc_example'], 200),
        ]);

        $provider = new DevinToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.devin.ai/api-reference/overview', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('devin_terminate_session', $tools);
        self::assertArrayHasKey('devin_list_session_messages', $tools);
        self::assertArrayHasKey('devin_generate_session_insights', $tools);
        self::assertArrayHasKey('devin_create_secret', $tools);
        self::assertSame(15, count($tools));

        self::assertTrue($provider->testConnection([
            'api_key' => 'cog_test',
            'org_id' => 'org_example',
        ])['success']);
    }
}
