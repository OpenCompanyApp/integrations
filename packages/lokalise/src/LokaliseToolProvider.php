<?php

namespace OpenCompany\Integrations\Lokalise;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Lokalise\Tools\LokaliseListProjects;
use OpenCompany\Integrations\Lokalise\Tools\LokaliseGetProject;
use OpenCompany\Integrations\Lokalise\Tools\LokaliseListKeys;
use OpenCompany\Integrations\Lokalise\Tools\LokaliseGetKey;
use OpenCompany\Integrations\Lokalise\Tools\LokaliseCreateKey;
use OpenCompany\Integrations\Lokalise\Tools\LokaliseListTranslations;
use OpenCompany\Integrations\Lokalise\Tools\LokaliseGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class LokaliseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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
        return 'lokalise';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Lokalise',
            'description' => 'Localization management platform',
            'icon' => 'ph:globe-stand',
            'logo' => 'simple-icons:lokalise',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Lokalise',
            'description' => 'Localization management platform for translating content across multiple languages',
            'icon' => 'ph:globe-stand',
            'logo' => 'simple-icons:lokalise',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.lokalise.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Lokalise API Token',
                'hint' => 'Generate an API token in <a href="https://app.lokalise.com/profile#api" target="_blank">Lokalise Profile → API Tokens</a>',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.lokalise.com/api2',
                'hint' => 'Defaults to <code>https://api.lokalise.com/api2</code>. Override only for custom endpoints.',
                'default' => 'https://api.lokalise.com/api2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.lokalise.com/api2', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error.message') ?? "HTTP {$response->status()}";
                return ['success' => false, 'error' => "Lokalise API error: {$error}"];
            }

            $user = $response->json('user') ?? [];

            return [
                'success' => true,
                'message' => "Connected to Lokalise API as " . ($user['email'] ?? $user['fullname'] ?? 'unknown user') . ".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'lokalise_list_projects' => [
                'class' => LokaliseListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List Lokalise projects.',
                'icon' => 'ph:folder',
            ],
            'lokalise_get_project' => [
                'class' => LokaliseGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific Lokalise project.',
                'icon' => 'ph:folder-open',
            ],
            'lokalise_list_keys' => [
                'class' => LokaliseListKeys::class,
                'type' => 'read',
                'name' => 'List Keys',
                'description' => 'List translation keys in a Lokalise project.',
                'icon' => 'ph:key',
            ],
            'lokalise_get_key' => [
                'class' => LokaliseGetKey::class,
                'type' => 'read',
                'name' => 'Get Key',
                'description' => 'Get details of a specific translation key.',
                'icon' => 'ph:key',
            ],
            'lokalise_create_key' => [
                'class' => LokaliseCreateKey::class,
                'type' => 'write',
                'name' => 'Create Key',
                'description' => 'Create a new translation key in a Lokalise project.',
                'icon' => 'ph:plus',
            ],
            'lokalise_list_translations' => [
                'class' => LokaliseListTranslations::class,
                'type' => 'read',
                'name' => 'List Translations',
                'description' => 'List translations in a Lokalise project.',
                'icon' => 'ph:translate',
            ],
            'lokalise_get_current_user' => [
                'class' => LokaliseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Lokalise user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/lokalise.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.lokalise.com/api2'],
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

            $service = new LokaliseService(
                apiToken: $creds->get('lokalise', 'api_token', '', $account),
                baseUrl: $creds->get('lokalise', 'base_url', 'https://api.lokalise.com/api2', $account),
            );

            return new $class($service);
        }

        return new $class(app(LokaliseService::class));
    }
}
