<?php

namespace OpenCompany\Integrations\OneSignal;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalListNotifications;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalGetNotification;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalCreateNotification;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalListDevices;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalGetDevice;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalListApps;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalGetCurrentApp;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class OneSignalToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * The integration identifier used for credential resolution.
     */
    public function appName(): string
    {
        return 'one-signal';
    }

/**
     * Short metadata shown in tool listings and UI summaries.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'OneSignal',
            'description' => 'Push notifications',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:onesignal',
        ];
    }

/**
     * Full integration metadata for the Integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'OneSignal',
            'description' => 'Multi-platform push notification service',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:onesignal',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://documentation.onesignal.com/docs/rest-api',
        ];
    }/**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'REST API Key',
                'placeholder' => 'Enter your OneSignal REST API key',
                'hint' => 'Find your REST API key in OneSignal under Settings > Keys & IDs',
                'required' => true,
            ],
            [
                'key' => 'app_id',
                'type' => 'string',
                'label' => 'Default App ID',
                'placeholder' => 'e.g. 12345678-abcd-efgh-ijkl-1234567890ab',
                'hint' => 'The default OneSignal App ID. You can override this per tool call.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://onesignal.com/api/v1',
                'hint' => 'Override only if using a custom OneSignal endpoint',
                'default' => 'https://onesignal.com/api/v1',
            ],
        ];
    }

    /**
     * Test the connection to the OneSignal API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://onesignal.com/api/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/apps');

            if (!$response->successful()) {
                $error = $response->json('errors') ?? "HTTP {$response->status()}";

                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            $apps = $response->json();

            return [
                'success' => true,
                'message' => 'Connected to OneSignal API. Found ' . count($apps) . ' app(s).',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration values.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'app_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'onesignal_list_notifications' => [
                'class' => OneSignalListNotifications::class,
                'type' => 'read',
                'name' => 'List Notifications',
                'description' => 'List push notifications sent via OneSignal.',
                'icon' => 'ph:bell',
            ],
            'onesignal_get_notification' => [
                'class' => OneSignalGetNotification::class,
                'type' => 'read',
                'name' => 'Get Notification',
                'description' => 'Get details of a specific push notification.',
                'icon' => 'ph:bell',
            ],
            'onesignal_create_notification' => [
                'class' => OneSignalCreateNotification::class,
                'type' => 'write',
                'name' => 'Create Notification',
                'description' => 'Send a new push notification.',
                'icon' => 'ph:bell-ringing',
            ],
            'onesignal_list_devices' => [
                'class' => OneSignalListDevices::class,
                'type' => 'read',
                'name' => 'List Devices',
                'description' => 'List devices registered in a OneSignal app.',
                'icon' => 'ph:device-mobile',
            ],
            'onesignal_get_device' => [
                'class' => OneSignalGetDevice::class,
                'type' => 'read',
                'name' => 'Get Device',
                'description' => 'Get details of a specific registered device.',
                'icon' => 'ph:device-mobile',
            ],
            'onesignal_list_apps' => [
                'class' => OneSignalListApps::class,
                'type' => 'read',
                'name' => 'List Apps',
                'description' => 'List all OneSignal apps.',
                'icon' => 'ph:app-window',
            ],
            'onesignal_get_current_app' => [
                'class' => OneSignalGetCurrentApp::class,
                'type' => 'read',
                'name' => 'Get Current App',
                'description' => 'Get details of a specific OneSignal app.',
                'icon' => 'ph:app-window',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/one-signal.md';
    }

    /**
     * Credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'REST API Key', 'required' => true],
            ['key' => 'app_id', 'type' => 'string', 'label' => 'App ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://onesignal.com/api/v1'],
        ];
    }

    /**
     * Confirm this class represents an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing an optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new OneSignalService(
                apiKey: $creds->get('one-signal', 'api_key', '', $account),
                appId: $creds->get('one-signal', 'app_id', '', $account),
                baseUrl: $creds->get('one-signal', 'url', 'https://onesignal.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(OneSignalService::class));
    }
}
