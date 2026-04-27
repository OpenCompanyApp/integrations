<?php

namespace OpenCompany\Integrations\Pushbullet;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletListPushes;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletCreatePush;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletDeletePush;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletListDevices;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PushbulletToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'pushbullet';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'push, devices, user',
            'description' => 'Push notifications',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:pushbullet',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pushbullet',
            'description' => 'Send push notifications and manage devices across platforms',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:pushbullet',
            'category' => 'notifications',
            'badge' => 'verified',
            'docs_url' => 'https://docs.pushbullet.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Pushbullet access token',
                'hint' => 'Create an access token in your Pushbullet account settings under "Access Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pushbullet.com/v2',
                'hint' => 'The Pushbullet API base URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://api.pushbullet.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.pushbullet.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Access-Token' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Pushbullet API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Pushbullet as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'pushbullet_list_pushes' => [
                'class' => PushbulletListPushes::class,
                'type' => 'read',
                'name' => 'List Pushes',
                'description' => 'List recent pushes (notifications).',
                'icon' => 'ph:list-bullets',
            ],
            'pushbullet_create_push' => [
                'class' => PushbulletCreatePush::class,
                'type' => 'write',
                'name' => 'Create Push',
                'description' => 'Send a push notification (note or link).',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'pushbullet_delete_push' => [
                'class' => PushbulletDeletePush::class,
                'type' => 'write',
                'name' => 'Delete Push',
                'description' => 'Delete a push notification.',
                'icon' => 'ph:trash',
            ],
            'pushbullet_list_devices' => [
                'class' => PushbulletListDevices::class,
                'type' => 'read',
                'name' => 'List Devices',
                'description' => 'List devices registered with Pushbullet.',
                'icon' => 'ph:devices',
            ],
            'pushbullet_get_current_user' => [
                'class' => PushbulletGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pushbullet.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pushbullet.com/v2'],
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

            $service = new PushbulletService(
                accessToken: $creds->get('pushbullet', 'access_token', '', $account),
                baseUrl: $creds->get('pushbullet', 'url', 'https://api.pushbullet.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(PushbulletService::class));
    }
}
