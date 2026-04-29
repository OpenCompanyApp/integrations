<?php

namespace OpenCompany\Integrations\Heroku;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Heroku\Tools\HerokuListApps;
use OpenCompany\Integrations\Heroku\Tools\HerokuGetApp;
use OpenCompany\Integrations\Heroku\Tools\HerokuListDynos;
use OpenCompany\Integrations\Heroku\Tools\HerokuListAddons;
use OpenCompany\Integrations\Heroku\Tools\HerokuListDomains;
use OpenCompany\Integrations\Heroku\Tools\HerokuListCollaborators;
use OpenCompany\Integrations\Heroku\Tools\HerokuGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class HerokuToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'heroku';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Heroku',
            'description' => 'Cloud platform',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:heroku',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Heroku',
            'description' => 'Cloud platform — manage apps, dynos, add-ons, domains, and collaborators',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:heroku',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://devcenter.heroku.com/articles/platform-api-reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Heroku API key',
                'hint' => 'Generate an API key in the Heroku dashboard under <strong>Account Settings → API Key</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.heroku.com',
                'hint' => 'Override only if using a custom Heroku-compatible endpoint',
                'default' => 'https://api.heroku.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.heroku.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/vnd.heroku+json; version=3',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/account');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Heroku API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Heroku API error ({$response->status()}): {$message}",
                ];
            }

            $email = $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Heroku as {$email}.",
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
            'heroku_list_apps' => [
                'class' => HerokuListApps::class,
                'type' => 'read',
                'name' => 'List Apps',
                'description' => 'List all Heroku apps the authenticated user has access to.',
                'icon' => 'ph:app-window',
            ],
            'heroku_get_app' => [
                'class' => HerokuGetApp::class,
                'type' => 'read',
                'name' => 'Get App',
                'description' => 'Get details for a specific Heroku app.',
                'icon' => 'ph:app-window',
            ],
            'heroku_list_dynos' => [
                'class' => HerokuListDynos::class,
                'type' => 'read',
                'name' => 'List Dynos',
                'description' => 'List all dynos for a given Heroku app.',
                'icon' => 'ph:cpu',
            ],
            'heroku_list_addons' => [
                'class' => HerokuListAddons::class,
                'type' => 'read',
                'name' => 'List Add-ons',
                'description' => 'List all add-ons attached to a given Heroku app.',
                'icon' => 'ph:puzzle-piece',
            ],
            'heroku_list_domains' => [
                'class' => HerokuListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List all domains for a given Heroku app.',
                'icon' => 'ph:globe',
            ],
            'heroku_list_collaborators' => [
                'class' => HerokuListCollaborators::class,
                'type' => 'read',
                'name' => 'List Collaborators',
                'description' => 'List all collaborators for a given Heroku app.',
                'icon' => 'ph:users',
            ],
            'heroku_get_current_user' => [
                'class' => HerokuGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/heroku.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.heroku.com'],
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

            $service = new HerokuService(
                apiKey: $creds->get('heroku', 'api_key', '', $account),
                baseUrl: $creds->get('heroku', 'url', 'https://api.heroku.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(HerokuService::class));
    }
}
