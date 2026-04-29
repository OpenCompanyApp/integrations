<?php

namespace OpenCompany\Integrations\Groq;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Groq\Tools\GroqListModels;
use OpenCompany\Integrations\Groq\Tools\GroqCreateCompletion;
use OpenCompany\Integrations\Groq\Tools\GroqListMessages;
use OpenCompany\Integrations\Groq\Tools\GroqCreateMessage;
use OpenCompany\Integrations\Groq\Tools\GroqListFiles;
use OpenCompany\Integrations\Groq\Tools\GroqGetFile;
use OpenCompany\Integrations\Groq\Tools\GroqGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GroqToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
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
        return 'groq';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Groq',
            'description' => 'Groq AI Inference',
            'icon' => 'ph:lightning',
            'logo' => 'logos:groq',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Groq',
            'description' => 'Groq fast AI inference — list models, create chat completions, manage conversations, messages, and files.',
            'icon' => 'ph:lightning',
            'logo' => 'logos:groq',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://console.groq.com/docs/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Groq API key',
                'hint' => 'Generate an API key in the <a href="https://console.groq.com/keys" target="_blank">Groq Console</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.groq.com/openai/v1',
                'hint' => 'Use the default Groq endpoint, or a compatible proxy URL',
                'default' => 'https://api.groq.com/openai/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.groq.com/openai/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/models');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Groq API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? 'Unknown error';
                return ['success' => false, 'error' => "API error: {$error}"];
            }

            return [
                'success' => true,
                'message' => "Connected to Groq API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
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
            'groq_list_models' => [
                'class' => GroqListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available Groq AI models.',
                'icon' => 'ph:list',
            ],
            'groq_create_completion' => [
                'class' => GroqCreateCompletion::class,
                'type' => 'write',
                'name' => 'Create Completion',
                'description' => 'Create a chat completion using a Groq model.',
                'icon' => 'ph:brain',
            ],
            'groq_list_messages' => [
                'class' => GroqListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages in a Groq conversation.',
                'icon' => 'ph:chat',
            ],
            'groq_create_message' => [
                'class' => GroqCreateMessage::class,
                'type' => 'write',
                'name' => 'Create Message',
                'description' => 'Create a message in a Groq conversation.',
                'icon' => 'ph:chat-circle-text',
            ],
            'groq_list_files' => [
                'class' => GroqListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List uploaded files in Groq.',
                'icon' => 'ph:files',
            ],
            'groq_get_file' => [
                'class' => GroqGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get details for an uploaded file.',
                'icon' => 'ph:file',
            ],
            'groq_get_current_user' => [
                'class' => GroqGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/groq.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.groq.com/openai/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GroqService(
                apiKey: $creds->get('groq', 'api_key', '', $account),
                baseUrl: $creds->get('groq', 'url', 'https://api.groq.com/openai/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(GroqService::class));
    }
}
