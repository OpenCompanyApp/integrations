<?php

namespace OpenCompany\Integrations\TogetherAi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\TogetherAi\Tools\TogetherAiListModels;
use OpenCompany\Integrations\TogetherAi\Tools\TogetherAiCreateCompletion;
use OpenCompany\Integrations\TogetherAi\Tools\TogetherAiListFineTunes;
use OpenCompany\Integrations\TogetherAi\Tools\TogetherAiGetFineTune;
use OpenCompany\Integrations\TogetherAi\Tools\TogetherAiListFiles;
use OpenCompany\Integrations\TogetherAi\Tools\TogetherAiGetFile;
use OpenCompany\Integrations\TogetherAi\Tools\TogetherAiGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TogetherAiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'together-ai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'models, completions, fine-tuning',
            'description' => 'AI inference & fine-tuning platform',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:togetherai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Together AI',
            'description' => 'Cloud AI inference platform with open-source models, chat completions, and fine-tuning',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:togetherai',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://docs.together.ai',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                'hint' => 'Generate an API key in your Together AI account settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.together.xyz/v1',
                'hint' => 'Use <code>https://api.together.xyz/v1</code> for the standard Together AI API',
                'default' => 'https://api.together.xyz/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.together.xyz/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user/info');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Together AI API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            $name = $json['name'] ?? $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Together AI API as {$name}.",
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
            'togetherai_list_models' => [
                'class' => TogetherAiListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available AI models on Together AI.',
                'icon' => 'ph:magnifying-glass',
            ],
            'togetherai_create_completion' => [
                'class' => TogetherAiCreateCompletion::class,
                'type' => 'write',
                'name' => 'Create Completion',
                'description' => 'Create a chat completion using a Together AI model.',
                'icon' => 'ph:chat-circle-text',
            ],
            'togetherai_list_fine_tunes' => [
                'class' => TogetherAiListFineTunes::class,
                'type' => 'read',
                'name' => 'List Fine-Tunes',
                'description' => 'List fine-tuning jobs on Together AI.',
                'icon' => 'ph:sliders',
            ],
            'togetherai_get_fine_tune' => [
                'class' => TogetherAiGetFineTune::class,
                'type' => 'read',
                'name' => 'Get Fine-Tune',
                'description' => 'Get details of a specific fine-tuning job.',
                'icon' => 'ph:sliders-horizontal',
            ],
            'togetherai_list_files' => [
                'class' => TogetherAiListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List files uploaded to Together AI.',
                'icon' => 'ph:files',
            ],
            'togetherai_get_file' => [
                'class' => TogetherAiGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get details of a specific file.',
                'icon' => 'ph:file',
            ],
            'togetherai_get_current_user' => [
                'class' => TogetherAiGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/together-ai.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.together.xyz/v1'],
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

            $service = new TogetherAiService(
                apiKey: $creds->get('together-ai', 'api_key', '', $account),
                baseUrl: $creds->get('together-ai', 'url', 'https://api.together.xyz/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(TogetherAiService::class));
    }
}
