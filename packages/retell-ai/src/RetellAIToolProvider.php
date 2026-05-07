<?php

namespace OpenCompany\Integrations\RetellAI;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIApiDelete;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIApiGet;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIApiPatch;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIApiPost;
use OpenCompany\Integrations\RetellAI\Tools\RetellAICreateAgent;
use OpenCompany\Integrations\RetellAI\Tools\RetellAICreateCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAICreateWebCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIDeleteAgent;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIDeleteCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIGetAgent;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIGetCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIGetCurrentUser;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIGetPhoneNumber;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIGetRetellLlm;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIGetVoice;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIListAgents;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIListCalls;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIListPhoneNumbers;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIListRetellLlms;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIListVoices;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIStopCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIUpdateAgent;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIUpdateCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIUpdatePhoneNumber;

/**
 * Exposes Retell AI tools and credential metadata to host applications.
 */
class RetellAIToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Retell AI API keys are sent as bearer tokens.'],
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
        return 'retell-ai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Retell AI',
            'description' => 'AI voice calls',
            'icon' => 'ph:phone-call',
            'logo' => 'simple-icons:retellai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Retell AI',
            'description' => 'Manage Retell AI agents, calls, phone numbers, LLMs, voices, and documented API endpoints.',
            'icon' => 'ph:phone-call',
            'logo' => 'simple-icons:retellai',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.retellai.com/api-references',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Retell AI API key',
                'hint' => 'Find your API key in the Retell AI dashboard.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.retellai.com',
                'hint' => 'Default: https://api.retellai.com. Older https://api.retellai.com/v2 configs are normalized automatically.',
                'default' => 'https://api.retellai.com',
            ],
        ];
    }

    /**
     * Verify the API key by listing agents.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = trim((string) ($config['api_key'] ?? ''));

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $service = new RetellAIService(
                apiKey: $apiKey,
                baseUrl: (string) ($config['url'] ?? 'https://api.retellai.com'),
            );
            $service->listAgents();

            return ['success' => true, 'message' => 'Connected to Retell AI API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'retell_ai_create_call' => ['class' => RetellAICreateCall::class, 'type' => 'write', 'name' => 'Create Phone Call', 'description' => 'Create a Retell phone call.', 'icon' => 'ph:phone-call'],
            'retell_ai_create_web_call' => ['class' => RetellAICreateWebCall::class, 'type' => 'write', 'name' => 'Create Web Call', 'description' => 'Create a Retell web call.', 'icon' => 'ph:globe'],
            'retell_ai_get_call' => ['class' => RetellAIGetCall::class, 'type' => 'read', 'name' => 'Get Call', 'description' => 'Get a call by ID.', 'icon' => 'ph:phone'],
            'retell_ai_list_calls' => ['class' => RetellAIListCalls::class, 'type' => 'read', 'name' => 'List Calls', 'description' => 'List calls.', 'icon' => 'ph:list'],
            'retell_ai_update_call' => ['class' => RetellAIUpdateCall::class, 'type' => 'write', 'name' => 'Update Call', 'description' => 'Update call metadata.', 'icon' => 'ph:pencil-simple'],
            'retell_ai_stop_call' => ['class' => RetellAIStopCall::class, 'type' => 'write', 'name' => 'Stop Call', 'description' => 'Stop an in-progress call.', 'icon' => 'ph:stop-circle'],
            'retell_ai_delete_call' => ['class' => RetellAIDeleteCall::class, 'type' => 'write', 'name' => 'Delete Call', 'description' => 'Delete a call record.', 'icon' => 'ph:trash'],
            'retell_ai_list_agents' => ['class' => RetellAIListAgents::class, 'type' => 'read', 'name' => 'List Agents', 'description' => 'List voice agents.', 'icon' => 'ph:users'],
            'retell_ai_get_agent' => ['class' => RetellAIGetAgent::class, 'type' => 'read', 'name' => 'Get Agent', 'description' => 'Get a voice agent.', 'icon' => 'ph:user-circle'],
            'retell_ai_create_agent' => ['class' => RetellAICreateAgent::class, 'type' => 'write', 'name' => 'Create Agent', 'description' => 'Create a voice agent.', 'icon' => 'ph:user-plus'],
            'retell_ai_update_agent' => ['class' => RetellAIUpdateAgent::class, 'type' => 'write', 'name' => 'Update Agent', 'description' => 'Update a voice agent.', 'icon' => 'ph:user-gear'],
            'retell_ai_delete_agent' => ['class' => RetellAIDeleteAgent::class, 'type' => 'write', 'name' => 'Delete Agent', 'description' => 'Delete a voice agent.', 'icon' => 'ph:trash'],
            'retell_ai_list_phone_numbers' => ['class' => RetellAIListPhoneNumbers::class, 'type' => 'read', 'name' => 'List Phone Numbers', 'description' => 'List phone numbers.', 'icon' => 'ph:phone-list'],
            'retell_ai_get_phone_number' => ['class' => RetellAIGetPhoneNumber::class, 'type' => 'read', 'name' => 'Get Phone Number', 'description' => 'Get a phone number.', 'icon' => 'ph:phone'],
            'retell_ai_update_phone_number' => ['class' => RetellAIUpdatePhoneNumber::class, 'type' => 'write', 'name' => 'Update Phone Number', 'description' => 'Update phone number routing.', 'icon' => 'ph:pencil-simple'],
            'retell_ai_list_retell_llms' => ['class' => RetellAIListRetellLlms::class, 'type' => 'read', 'name' => 'List Retell LLMs', 'description' => 'List Retell LLMs.', 'icon' => 'ph:brain'],
            'retell_ai_get_retell_llm' => ['class' => RetellAIGetRetellLlm::class, 'type' => 'read', 'name' => 'Get Retell LLM', 'description' => 'Get a Retell LLM.', 'icon' => 'ph:brain'],
            'retell_ai_list_voices' => ['class' => RetellAIListVoices::class, 'type' => 'read', 'name' => 'List Voices', 'description' => 'List voices.', 'icon' => 'ph:waveform'],
            'retell_ai_get_voice' => ['class' => RetellAIGetVoice::class, 'type' => 'read', 'name' => 'Get Voice', 'description' => 'Get a voice.', 'icon' => 'ph:waveform'],
            'retell_ai_get_current_user' => ['class' => RetellAIGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Compatibility connectivity check using list agents.', 'icon' => 'ph:user'],
            'retell_ai_api_get' => ['class' => RetellAIApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a documented GET endpoint.', 'icon' => 'ph:terminal-window'],
            'retell_ai_api_post' => ['class' => RetellAIApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a documented POST endpoint.', 'icon' => 'ph:terminal-window'],
            'retell_ai_api_patch' => ['class' => RetellAIApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a documented PATCH endpoint.', 'icon' => 'ph:terminal-window'],
            'retell_ai_api_delete' => ['class' => RetellAIApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a documented DELETE endpoint.', 'icon' => 'ph:terminal-window'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/retell-ai.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.retellai.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Retell AI service for the default or selected account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): RetellAIService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $apiKey = $creds->get('retell-ai', 'api_key', '', $account)
                ?: $creds->get('retell', 'api_key', '', $account)
                ?: $creds->get('retell', 'access_token', '', $account);
            $baseUrl = $creds->get('retell-ai', 'url', '', $account)
                ?: $creds->get('retell', 'url', 'https://api.retellai.com', $account);

            return new RetellAIService(
                apiKey: $apiKey,
                baseUrl: $baseUrl,
            );
        }

        return app(RetellAIService::class);
    }
}
