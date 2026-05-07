<?php

namespace OpenCompany\Integrations\BlandAI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIAnalyzeCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIChatKnowledgeBase;
use OpenCompany\Integrations\BlandAI\Tools\BlandAICreateBatch;
use OpenCompany\Integrations\BlandAI\Tools\BlandAICreateTextKnowledgeBase;
use OpenCompany\Integrations\BlandAI\Tools\BlandAICreateTool;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIGetCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIGetCurrentUser;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIGetVoice;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIListBatches;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIListCalls;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIListKnowledgeBases;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIListVoices;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIMakeCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIStopAllActiveCalls;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIStopCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIUpdateKnowledgeBase;

/**
 * Tool provider for the Bland AI integration.
 *
 * Exposes documented call, batch, voice, knowledge-base, and custom-tool operations.
 */
class BlandAIToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'blandai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Bland AI',
            'description' => 'AI phone calls and voice agents',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:blandai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Bland AI',
            'description' => 'AI phone calls, batches, voices, knowledge bases, and custom call tools',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:blandai',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.bland.ai/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Bland AI API key',
                'hint' => 'Generate an API key in your Bland AI dashboard.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.bland.ai',
                'hint' => 'Use https://api.bland.ai unless Bland support provided a regional endpoint.',
                'default' => 'https://api.bland.ai',
            ],
        ];
    }

    /**
     * Test the API connection with the given configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = preg_replace('#/(v1|v2)$#', '', rtrim((string) ($config['url'] ?? 'https://api.bland.ai'), '/')) ?: 'https://api.bland.ai';

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'authorization' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/calls', ['limit' => 1]);

            return $response->successful()
                ? ['success' => true, 'message' => "Connected to Bland AI API at {$baseUrl}."]
                : ['success' => false, 'error' => "Bland AI API returned HTTP {$response->status()}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'blandai_make_call' => ['class' => BlandAIMakeCall::class, 'type' => 'write', 'name' => 'Make Call', 'description' => 'Send an AI-powered phone call.', 'icon' => 'ph:phone'],
            'blandai_get_call' => ['class' => BlandAIGetCall::class, 'type' => 'read', 'name' => 'Get Call', 'description' => 'Retrieve call details and transcript.', 'icon' => 'ph:phone-call'],
            'blandai_list_calls' => ['class' => BlandAIListCalls::class, 'type' => 'read', 'name' => 'List Calls', 'description' => 'List calls with filters.', 'icon' => 'ph:list'],
            'blandai_stop_call' => ['class' => BlandAIStopCall::class, 'type' => 'write', 'name' => 'Stop Call', 'description' => 'Stop one active call.', 'icon' => 'ph:phone-disconnect'],
            'blandai_stop_all_active_calls' => ['class' => BlandAIStopAllActiveCalls::class, 'type' => 'write', 'name' => 'Stop All Active Calls', 'description' => 'Stop all active calls.', 'icon' => 'ph:phone-x'],
            'blandai_analyze_call' => ['class' => BlandAIAnalyzeCall::class, 'type' => 'read', 'name' => 'Analyze Call', 'description' => 'Analyze a call transcript.', 'icon' => 'ph:brain'],
            'blandai_create_batch' => ['class' => BlandAICreateBatch::class, 'type' => 'write', 'name' => 'Create Batch', 'description' => 'Create a batch or campaign.', 'icon' => 'ph:stack'],
            'blandai_list_batches' => ['class' => BlandAIListBatches::class, 'type' => 'read', 'name' => 'List Batches', 'description' => 'List batches and campaigns.', 'icon' => 'ph:cards'],
            'blandai_list_voices' => ['class' => BlandAIListVoices::class, 'type' => 'read', 'name' => 'List Voices', 'description' => 'List available voices.', 'icon' => 'ph:waveform'],
            'blandai_get_voice' => ['class' => BlandAIGetVoice::class, 'type' => 'read', 'name' => 'Get Voice', 'description' => 'Get voice details.', 'icon' => 'ph:speaker-high'],
            'blandai_list_knowledge_bases' => ['class' => BlandAIListKnowledgeBases::class, 'type' => 'read', 'name' => 'List Knowledge Bases', 'description' => 'List knowledge bases.', 'icon' => 'ph:books'],
            'blandai_create_text_knowledge_base' => ['class' => BlandAICreateTextKnowledgeBase::class, 'type' => 'write', 'name' => 'Create Text Knowledge Base', 'description' => 'Create a text knowledge base.', 'icon' => 'ph:file-text'],
            'blandai_update_knowledge_base' => ['class' => BlandAIUpdateKnowledgeBase::class, 'type' => 'write', 'name' => 'Update Knowledge Base', 'description' => 'Update knowledge base metadata.', 'icon' => 'ph:pencil-simple'],
            'blandai_chat_knowledge_base' => ['class' => BlandAIChatKnowledgeBase::class, 'type' => 'write', 'name' => 'Chat Knowledge Base', 'description' => 'Chat with a knowledge base.', 'icon' => 'ph:chat-text'],
            'blandai_create_tool' => ['class' => BlandAICreateTool::class, 'type' => 'write', 'name' => 'Create Tool', 'description' => 'Create a custom call tool.', 'icon' => 'ph:wrench'],
            'blandai_get_current_user' => ['class' => BlandAIGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Compatibility credential check via call list.', 'icon' => 'ph:user'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/blandai.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.bland.ai'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  string  $class  Tool class name
     * @param  array<string, mixed>  $context  Optional account context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Bland AI service for default or named-account credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context
     */
    private function resolveService(array $context = []): BlandAIService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BlandAIService(
                apiKey: $creds->get('blandai', 'api_key', '', $account),
                baseUrl: $creds->get('blandai', 'url', 'https://api.bland.ai', $account),
            );
        }

        return app(BlandAIService::class);
    }
}
