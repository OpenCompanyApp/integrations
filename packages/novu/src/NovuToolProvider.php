<?php

namespace OpenCompany\Integrations\Novu;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Novu\Tools\NovuListNotifications;
use OpenCompany\Integrations\Novu\Tools\NovuGetNotification;
use OpenCompany\Integrations\Novu\Tools\NovuListSubscribers;
use OpenCompany\Integrations\Novu\Tools\NovuGetSubscriber;
use OpenCompany\Integrations\Novu\Tools\NovuCreateSubscriber;
use OpenCompany\Integrations\Novu\Tools\NovuTriggerEvent;
use OpenCompany\Integrations\Novu\Tools\NovuGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class NovuToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'novu';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'notifications, subscribers, events',
            'description' => 'Notification platform',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:novu',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Novu',
            'description' => 'Open-source notification platform for developers',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:novu',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://docs.novu.co/api-reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Novu API key',
                'hint' => 'Generate an API key in your Novu dashboard under "API Keys" in Settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.novu.co',
                'hint' => 'Use <code>https://api.novu.co</code> for Novu Cloud, or your self-hosted Novu API URL',
                'default' => 'https://api.novu.co',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.novu.co', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Novu API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your API key.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Novu API at {$baseUrl}.",
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
            'novu_list_notifications' => [
                'class' => NovuListNotifications::class,
                'type' => 'read',
                'name' => 'List Notifications',
                'description' => 'List notifications with optional filtering by channel.',
                'icon' => 'ph:bell',
            ],
            'novu_get_notification' => [
                'class' => NovuGetNotification::class,
                'type' => 'read',
                'name' => 'Get Notification',
                'description' => 'Get details of a specific notification.',
                'icon' => 'ph:bell',
            ],
            'novu_list_subscribers' => [
                'class' => NovuListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List all notification subscribers.',
                'icon' => 'ph:users',
            ],
            'novu_get_subscriber' => [
                'class' => NovuGetSubscriber::class,
                'type' => 'read',
                'name' => 'Get Subscriber',
                'description' => 'Get details of a specific subscriber.',
                'icon' => 'ph:user',
            ],
            'novu_create_subscriber' => [
                'class' => NovuCreateSubscriber::class,
                'type' => 'write',
                'name' => 'Create Subscriber',
                'description' => 'Create a new notification subscriber.',
                'icon' => 'ph:user-plus',
            ],
            'novu_trigger_event' => [
                'class' => NovuTriggerEvent::class,
                'type' => 'write',
                'name' => 'Trigger Event',
                'description' => 'Trigger a notification event to one or more subscribers.',
                'icon' => 'ph:lightning',
            ],
            'novu_get_current_user' => [
                'class' => NovuGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Novu user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/novu.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Novu API URL', 'required' => false, 'default' => 'https://api.novu.co'],
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

            $service = new NovuService(
                apiKey: $creds->get('novu', 'api_key', '', $account),
                baseUrl: $creds->get('novu', 'url', 'https://api.novu.co', $account),
            );

            return new $class($service);
        }

        return new $class(app(NovuService::class));
    }
}
