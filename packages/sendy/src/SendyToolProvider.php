<?php

namespace OpenCompany\Integrations\Sendy;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Sendy\Tools\SendyCreateCampaign;
use OpenCompany\Integrations\Sendy\Tools\SendyDeleteSubscriber;
use OpenCompany\Integrations\Sendy\Tools\SendyGetBrands;
use OpenCompany\Integrations\Sendy\Tools\SendyGetCurrentUser;
use OpenCompany\Integrations\Sendy\Tools\SendyGetLists;
use OpenCompany\Integrations\Sendy\Tools\SendyListSubscribers;
use OpenCompany\Integrations\Sendy\Tools\SendySubscribe;
use OpenCompany\Integrations\Sendy\Tools\SendySubscriptionStatus;
use OpenCompany\Integrations\Sendy\Tools\SendyUnsubscribe;

/**
 * Tool provider for the Sendy integration.
 *
 * Exposes Sendy's official API operations for subscribers, lists, brands, and campaigns.
 */
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
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
        return 'sendy';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Sendy',
            'description' => 'Self-hosted email newsletter lists and campaigns',
            'icon' => 'ph:envelope-simple',
            'logo' => 'ph:envelope-simple',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Sendy',
            'description' => 'Manage Sendy subscribers, lists, brands, and campaigns',
            'icon' => 'ph:envelope-simple',
            'logo' => 'ph:envelope-simple',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://sendy.co/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Sendy API key',
                'hint' => 'Find your API key in Sendy under Settings > API Key.',
                'required' => true,
            ],
            [
                'key' => 'hostname',
                'type' => 'url',
                'label' => 'Sendy Hostname',
                'placeholder' => 'https://sendy.example.test',
                'hint' => 'The base URL of your Sendy installation.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to a Sendy installation.
     *
     * @param  array<string, mixed>  $config  Integration configuration
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['hostname'] ?? ''), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }
        if ($baseUrl === '') {
            return ['success' => false, 'error' => 'No hostname provided'];
        }

        try {
            $response = Http::asForm()->timeout(10)->post($baseUrl . '/api/brands/get-brands.php', [
                'api_key' => $apiKey,
            ]);

            $body = trim($response->body());
            if ($response->successful() && $body !== '' && ! str_starts_with($body, 'Invalid')) {
                return [
                    'success' => true,
                    'message' => "Connected to Sendy at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Could not connect to Sendy at {$baseUrl}. Check your API key and hostname.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'hostname' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'sendy_subscribe' => [
                'class' => SendySubscribe::class,
                'type' => 'write',
                'name' => 'Subscribe',
                'description' => 'Subscribe or update an email address on a Sendy list.',
                'icon' => 'ph:user-plus',
            ],
            'sendy_unsubscribe' => [
                'class' => SendyUnsubscribe::class,
                'type' => 'write',
                'name' => 'Unsubscribe',
                'description' => 'Unsubscribe an email address from a Sendy list.',
                'icon' => 'ph:user-minus',
            ],
            'sendy_delete_subscriber' => [
                'class' => SendyDeleteSubscriber::class,
                'type' => 'write',
                'name' => 'Delete Subscriber',
                'description' => 'Delete a subscriber from a Sendy list.',
                'icon' => 'ph:user-x',
            ],
            'sendy_subscription_status' => [
                'class' => SendySubscriptionStatus::class,
                'type' => 'read',
                'name' => 'Subscription Status',
                'description' => 'Get a subscriber status in a Sendy list.',
                'icon' => 'ph:user-focus',
            ],
            'sendy_list_subscribers' => [
                'class' => SendyListSubscribers::class,
                'type' => 'read',
                'name' => 'Active Subscriber Count',
                'description' => 'Get the active subscriber count for a Sendy list.',
                'icon' => 'ph:users',
            ],
            'sendy_get_lists' => [
                'class' => SendyGetLists::class,
                'type' => 'read',
                'name' => 'Get Lists',
                'description' => 'Get lists for a Sendy brand.',
                'icon' => 'ph:list-bullets',
            ],
            'sendy_get_brands' => [
                'class' => SendyGetBrands::class,
                'type' => 'read',
                'name' => 'Get Brands',
                'description' => 'Get Sendy brands visible to the API key.',
                'icon' => 'ph:buildings',
            ],
            'sendy_create_campaign' => [
                'class' => SendyCreateCampaign::class,
                'type' => 'write',
                'name' => 'Create Campaign',
                'description' => 'Create, send, or schedule a Sendy email campaign.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'sendy_get_current_user' => [
                'class' => SendyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Compatibility alias for Sendy get brands.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/sendy.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Sendy Hostname', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  string  $class  Tool class name
     * @param  array<string, mixed>  $context  Optional account context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve Sendy service credentials for default or named accounts.
     *
     * @param  array<string, mixed>  $context  Optional account context
     */
    private function resolveService(array $context = []): SendyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SendyService(
                apiKey: $creds->get('sendy', 'api_key', '', $account),
                baseUrl: $creds->get('sendy', 'hostname', '', $account),
            );
        }

        return app(SendyService::class);
    }
}
