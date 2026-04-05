<?php

namespace OpenCompany\Integrations\BlandAI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIMakeCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIGetCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIListCalls;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIAnalyzeCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIGetCurrentUser;

/**
 * Tool provider for the BlandAI integration.
 *
 * Implements ConfigurableIntegration for multi-account support, config schema,
 * connection testing, and credential management. Registers all BlandAI tools
 * with the ToolProviderRegistry.
 */
class BlandAIToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'blandai';
    }

    /**
     * Get metadata for display in the integrations UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'calls, analyze, telephony',
            'description' => 'AI-powered phone calls',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:blandai',
        ];
    }

    /**
     * Get integration metadata for marketplace/settings display.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'BlandAI',
            'description' => 'AI-powered phone calls and call analytics',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:blandai',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://docs.bland.ai',
        ];
    }

    /**
     * Get the configuration schema for the integrations UI.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your BlandAI API key',
                'hint' => 'Generate an API key in your BlandAI dashboard under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.bland.ai/v1',
                'hint' => 'Use <code>https://api.bland.ai/v1</code> for the default BlandAI API',
                'default' => 'https://api.bland.ai/v1',
            ],
        ];
    }

    /**
     * Test the API connection with the given configuration.
     *
     * @param  array  $config  Configuration array containing api_key and optional url.
     * @return array Result with 'success' bool and 'message' or 'error' string.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.bland.ai/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/calls', [
                'limit' => 1,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach BlandAI API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to BlandAI API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all available BlandAI tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'blandai_make_call' => [
                'class' => BlandAIMakeCall::class,
                'type' => 'write',
                'name' => 'Make Call',
                'description' => 'Initiate an AI-powered phone call.',
                'icon' => 'ph:phone',
            ],
            'blandai_get_call' => [
                'class' => BlandAIGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Retrieve details and transcript for a specific call.',
                'icon' => 'ph:phone-call',
            ],
            'blandai_list_calls' => [
                'class' => BlandAIListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List phone calls with optional filtering.',
                'icon' => 'ph:list',
            ],
            'blandai_analyze_call' => [
                'class' => BlandAIAnalyzeCall::class,
                'type' => 'read',
                'name' => 'Analyze Call',
                'description' => 'Analyze a call transcript with a custom prompt.',
                'icon' => 'ph:brain',
            ],
            'blandai_get_current_user' => [
                'class' => BlandAIGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/blandai.md';
    }

    /**
     * Get the credential field definitions for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.bland.ai/v1'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array  $context  Optional context containing 'account' for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BlandAIService(
                apiKey: $creds->get('blandai', 'api_key', '', $account),
                baseUrl: $creds->get('blandai', 'url', 'https://api.bland.ai/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(BlandAIService::class));
    }
}
