<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Anthropic;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Anthropic\AnthropicService;
use OpenCompany\Integrations\Anthropic\AnthropicToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Anthropic endpoint coverage and metadata.
 */
final class AnthropicServiceTest extends TestCase
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

    public function test_messages_batches_files_and_admin_endpoints_use_expected_headers(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AnthropicService('workspace-key', 'https://api.anthropic.test/v1', 'admin-key');

        $service->countMessageTokens([
            'model' => 'claude-sonnet-4-20250514',
            'messages' => [['role' => 'user', 'content' => 'Hello']],
        ]);
        $service->createMessageBatch(['requests' => []]);
        $service->listFiles(['limit' => 5]);
        $service->getOrganization();

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.anthropic.test/v1/messages/count_tokens'
            && $request->hasHeader('x-api-key', 'workspace-key'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.anthropic.test/v1/messages/batches');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.anthropic.test/v1/files?limit=5'
            && $request->hasHeader('anthropic-beta', 'files-api-2025-04-14'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.anthropic.test/v1/organizations/me'
            && $request->hasHeader('x-api-key', 'admin-key'));
    }

    public function test_unsupported_message_history_and_provider_metadata_are_explicit(): void
    {
        $service = new AnthropicService('workspace-key', 'https://api.anthropic.test/v1', 'admin-key');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('does not provide a message history listing endpoint');
        $service->listMessages();
    }

    public function test_provider_registers_expanded_tool_catalog(): void
    {
        $provider = new AnthropicToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertGreaterThanOrEqual(25, count($tools));
        self::assertArrayHasKey('anthropic_count_message_tokens', $tools);
        self::assertArrayHasKey('anthropic_create_message_batch', $tools);
        self::assertArrayHasKey('anthropic_list_files', $tools);
        self::assertArrayHasKey('anthropic_get_organization', $tools);
        self::assertArrayHasKey('anthropic_list_api_keys', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new AnthropicService('workspace-key', 'https://api.anthropic.test/v1', 'admin-key'));
            $names[] = $instance->name();
        }

        self::assertCount(count($names), array_unique($names));
    }
}
