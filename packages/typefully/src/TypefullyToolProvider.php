<?php

namespace OpenCompany\Integrations\Typefully;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Typefully\Tools\TypefullyCreateDraft;
use OpenCompany\Integrations\Typefully\Tools\TypefullyListScheduled;
use OpenCompany\Integrations\Typefully\Tools\TypefullyListPublished;
use OpenCompany\Integrations\Typefully\Tools\TypefullyGetDraft;
use OpenCompany\Integrations\Typefully\Tools\TypefullyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TypefullyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'typefully';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Typefully',
            'description' => 'Social media scheduling',
            'icon' => 'ph:pen-nib',
            'logo' => 'simple-icons:typefully',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Typefully',
            'description' => 'Write, schedule, and publish tweets and newsletters',
            'icon' => 'ph:pen-nib',
            'logo' => 'simple-icons:typefully',
            'category' => 'social-media',
            'badge' => 'verified',
            'docs_url' => 'https://support.typefully.com/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Typefully API key',
                'hint' => 'Generate an API key in your Typefully account settings under "API"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.typefully.com/v1',
                'hint' => 'Use the default <code>https://api.typefully.com/v1</code> unless you have a custom endpoint',
                'default' => 'https://api.typefully.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.typefully.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me/');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Typefully API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Typefully API error: {$error}",
                ];
            }

            $handle = $json['handle'] ?? $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Typefully as @{$handle}.",
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
            'typefully_create_draft' => [
                'class' => TypefullyCreateDraft::class,
                'type' => 'write',
                'name' => 'Create Draft',
                'description' => 'Create a new tweet, thread, or newsletter draft.',
                'icon' => 'ph:pencil-simple-line',
            ],
            'typefully_list_scheduled' => [
                'class' => TypefullyListScheduled::class,
                'type' => 'read',
                'name' => 'List Scheduled',
                'description' => 'List scheduled drafts awaiting publication.',
                'icon' => 'ph:clock',
            ],
            'typefully_list_published' => [
                'class' => TypefullyListPublished::class,
                'type' => 'read',
                'name' => 'List Published',
                'description' => 'List already published drafts.',
                'icon' => 'ph:check-circle',
            ],
            'typefully_get_draft' => [
                'class' => TypefullyGetDraft::class,
                'type' => 'read',
                'name' => 'Get Draft',
                'description' => 'Get details of a specific draft by ID.',
                'icon' => 'ph:document-text',
            ],
            'typefully_get_current_user' => [
                'class' => TypefullyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s Typefully profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/typefully.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.typefully.com/v1'],
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

            $service = new TypefullyService(
                apiKey: $creds->get('typefully', 'api_key', '', $account),
                baseUrl: $creds->get('typefully', 'url', 'https://api.typefully.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(TypefullyService::class));
    }
}
