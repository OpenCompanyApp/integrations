<?php

namespace OpenCompany\Integrations\Sendy;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Sendy\Tools\SendySubscribe;
use OpenCompany\Integrations\Sendy\Tools\SendyUnsubscribe;
use OpenCompany\Integrations\Sendy\Tools\SendyListSubscribers;
use OpenCompany\Integrations\Sendy\Tools\SendyCreateCampaign;
use OpenCompany\Integrations\Sendy\Tools\SendyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SendyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'sendy';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Sendy',
            'description' => 'Sendy newsletter integration for Laravel — manage subscribers, campaigns, and brands.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Sendy',
            'description' => 'Sendy newsletter integration for Laravel — manage subscribers, campaigns, and brands.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the Sendy integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Sendy API key',
                'hint' => 'Find your API key in Sendy under Settings → API Key',
                'required' => true,
            ],
            [
                'key' => 'hostname',
                'type' => 'url',
                'label' => 'Sendy Hostname',
                'placeholder' => 'https://sendy.example.com',
                'hint' => 'The base URL of your Sendy installation (e.g., <code>https://sendy.example.com</code>)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Sendy API.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['hostname'] ?? '', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No hostname provided'];
        }

        try {
            $response = Http::asForm()->timeout(10)->post($baseUrl . '/api/brands.php', [
                'api_key' => $apiKey,
            ]);

            $body = trim($response->body());

            if ($response->successful() && !str_starts_with($body, 'Invalid')) {
                return [
                    'success' => true,
                    'message' => "Connected to Sendy at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Could not connect to Sendy at {$baseUrl}. Check your API key and hostname.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for configuration values.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'hostname' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by the Sendy integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'sendy_subscribe' => [
                'class' => SendySubscribe::class,
                'type' => 'write',
                'name' => 'Subscribe',
                'description' => 'Subscribe an email address to a Sendy mailing list.',
                'icon' => 'ph:user-plus',
            ],
            'sendy_unsubscribe' => [
                'class' => SendyUnsubscribe::class,
                'type' => 'write',
                'name' => 'Unsubscribe',
                'description' => 'Unsubscribe an email address from a Sendy mailing list.',
                'icon' => 'ph:user-minus',
            ],
            'sendy_list_subscribers' => [
                'class' => SendyListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'Get the total subscriber count for a Sendy list.',
                'icon' => 'ph:users',
            ],
            'sendy_create_campaign' => [
                'class' => SendyCreateCampaign::class,
                'type' => 'write',
                'name' => 'Create Campaign',
                'description' => 'Create and optionally send a new email campaign.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'sendy_get_current_user' => [
                'class' => SendyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get brand/account information from Sendy.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/sendy.md';
    }

    /**
     * Get the credential fields for the Sendy integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Sendy Hostname', 'required' => true],
        ];
    }

    /**
     * Confirm this is an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     * @return Tool
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SendyService(
                apiKey: $creds->get('sendy', 'api_key', '', $account),
                baseUrl: $creds->get('sendy', 'hostname', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(SendyService::class));
    }
}
