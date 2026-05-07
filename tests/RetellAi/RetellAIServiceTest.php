<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\RetellAi;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Retell\RetellToolProvider as LegacyRetellToolProvider;
use OpenCompany\Integrations\RetellAI\RetellAIService;
use OpenCompany\Integrations\RetellAI\RetellAIToolProvider;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIApiGet;
use OpenCompany\Integrations\RetellAI\Tools\RetellAICreateWebCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIListAgents;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIStopCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIUpdateAgent;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Retell AI API coverage.
 */
final class RetellAIServiceTest extends TestCase
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

    public function test_service_maps_calls_agents_numbers_llms_voices_and_generic_helpers(): void
    {
        Http::fake([
            'https://api.retellai.com/*' => Http::response(['ok' => true, 'call_id' => 'call_1'], 200),
        ]);

        $service = new RetellAIService('retell_test', 'https://api.retellai.com/v2');

        $service->createCall('agent_1', ['customer_id' => 'cus_1'], ['from_number' => '+14155550100', 'to_number' => '+14155550199']);
        $service->createWebCall(['agent_id' => 'agent_1']);
        $service->getCall('call_1');
        $service->listCalls(['agent_id' => 'agent_1']);
        $service->updateCall('call_1', ['metadata' => ['reviewed' => true]]);
        $service->stopCall('call_1');
        $service->deleteCall('call_1');
        $service->listAgents();
        $service->getAgent('agent_1');
        $service->createAgent('voice_1', 'You are helpful.', ['agent_name' => 'Support']);
        $service->updateAgent('agent_1', ['agent_name' => 'Updated']);
        $service->deleteAgent('agent_1');
        $service->listPhoneNumbers();
        $service->getPhoneNumber('+14155550100');
        $service->updatePhoneNumber('+14155550100', ['inbound_agent_id' => 'agent_1']);
        $service->listRetellLlms();
        $service->getRetellLlm('llm_1');
        $service->listVoices();
        $service->getVoice('voice_1');
        $service->apiGet('/list-conversation-flows');
        $service->apiPost('/create-retell-llm', ['general_prompt' => 'Hello']);
        $service->apiPatch('/update-agent/agent_1', ['agent_name' => 'Updated']);
        $service->apiDelete('/delete-retell-llm/llm_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer retell_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.retellai.com/v2/create-phone-call');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.retellai.com/v2/list-calls');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.retellai.com/v2/update-call/call_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.retellai.com/v2/delete-call/call_1');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.retellai.com/list-agents');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.retellai.com/get-agent/agent_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.retellai.com/update-agent/agent_1');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.retellai.com/v2/list-phone-numbers');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.retellai.com/get-phone-number/%2B14155550100');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.retellai.com/v2/list-retell-llms');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.retellai.com/list-voices');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.retellai.com/list-conversation-flows');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.retellai.com/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new RetellAIService('retell_test');

        self::assertTrue((new RetellAICreateWebCall($service))->execute([
            'data' => ['agent_id' => 'agent_1'],
        ])->succeeded());
        self::assertTrue((new RetellAIUpdateAgent($service))->execute([
            'agent_id' => 'agent_1',
            'data' => ['agent_name' => 'Updated'],
        ])->succeeded());
        self::assertTrue((new RetellAIStopCall($service))->execute([
            'call_id' => 'call_1',
        ])->succeeded());
        self::assertTrue((new RetellAIApiGet($service))->execute([
            'path' => '/list-voices',
        ])->succeeded());
        self::assertFalse((new RetellAIStopCall($service))->execute([
            'call_id' => '',
        ])->succeeded());
        self::assertFalse((new RetellAIApiGet($service))->execute([
            'path' => 'https://example.test/list-voices',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.retellai.com/list-agents' => Http::response(['data' => []], 200),
        ]);

        $provider = new RetellAIToolProvider();
        $tools = $provider->tools();
        $composer = json_decode((string) file_get_contents(__DIR__.'/../../packages/retell-ai/composer.json'), true);

        self::assertSame('retell-ai', $provider->appName());
        self::assertSame('Retell AI', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.retellai.com/api-references', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('self.version', $composer['replace']['opencompanyapp/integration-retell'] ?? null);
        self::assertArrayHasKey('retell_ai_create_web_call', $tools);
        self::assertArrayHasKey('retell_ai_update_call', $tools);
        self::assertArrayHasKey('retell_ai_get_agent', $tools);
        self::assertArrayHasKey('retell_ai_list_phone_numbers', $tools);
        self::assertArrayHasKey('retell_ai_list_retell_llms', $tools);
        self::assertArrayHasKey('retell_ai_api_delete', $tools);
        self::assertSame(24, count($tools));

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }

        self::assertTrue($provider->testConnection([
            'api_key' => 'retell_test',
        ])['success']);
    }

    public function test_legacy_provider_defers_to_canonical_retell_ai_namespace(): void
    {
        $provider = new LegacyRetellToolProvider;

        self::assertSame('retell-ai', $provider->appName());
        self::assertSame('Retell AI', $provider->integrationMeta()['name']);
        self::assertCount(24, $provider->tools());
    }

    public function test_multi_account_resolution_supports_legacy_access_token_credentials(): void
    {
        Http::fake([
            'https://api.retellai.com/list-agents' => Http::response(['data' => []], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'retell-ai') {
                    return '';
                }

                $values = [
                    'access_token' => $account === 'work' ? 'legacy-retell-token' : 'legacy-default-token',
                    'url' => 'https://api.retellai.com/v2',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $tool = (new RetellAIToolProvider)->createTool(RetellAIListAgents::class, ['account' => 'work']);

        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.retellai.com/list-agents'
            && $request->hasHeader('Authorization', 'Bearer legacy-retell-token'));
    }
}
