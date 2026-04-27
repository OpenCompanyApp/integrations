<?php

namespace OpenCompany\Integrations\Pushover;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pushover\Tools\PushoverSendMessage;
use OpenCompany\Integrations\Pushover\Tools\PushoverListSounds;
use OpenCompany\Integrations\Pushover\Tools\PushoverGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PushoverToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'pushover';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'send, sounds, validate',
            'description' => 'Push notifications',
            'icon' => 'ph:bell-ringing',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pushover',
            'description' => 'Send push notifications to your devices',
            'icon' => 'ph:bell-ringing',
            'category' => 'notifications',
            'badge' => 'verified',
            'docs_url' => 'https://pushover.net/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Application API Key (Token)',
                'placeholder' => 'Enter your Pushover application API key',
                'hint' => 'Create an application at <a href="https://pushover.net/apps" target="_blank">pushover.net/apps</a> to get an API token',
                'required' => true,
            ],
            [
                'key' => 'user_key',
                'type' => 'secret',
                'label' => 'User Key',
                'placeholder' => 'Enter your Pushover user key',
                'hint' => 'Found on your <a href="https://pushover.net/" target="_blank">Pushover dashboard</a> homepage',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pushover.net/1',
                'hint' => 'Override only if using a Pushover-compatible self-hosted service',
                'default' => 'https://api.pushover.net/1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $userKey = $config['user_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.pushover.net/1', '/');

        if (empty($apiKey) || empty($userKey)) {
            return ['success' => false, 'error' => 'API key and user key are required.'];
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post($baseUrl . '/users/validate.json', [
                    'user' => $userKey,
                    'token' => $apiKey,
                ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Pushover API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!($json['status'] ?? false)) {
                $errors = $json['errors'] ?? ['Invalid credentials'];
                return [
                    'success' => false,
                    'error' => implode('; ', $errors),
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Pushover API successfully.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'user_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'pushover_send_message' => [
                'class' => PushoverSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a push notification message.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'pushover_list_sounds' => [
                'class' => PushoverListSounds::class,
                'type' => 'read',
                'name' => 'List Sounds',
                'description' => 'List available notification sounds.',
                'icon' => 'ph:speaker-high',
            ],
            'pushover_get_current_user' => [
                'class' => PushoverGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Validate and retrieve the current user info.',
                'icon' => 'ph:user-check',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pushover.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Application API Key', 'required' => true],
            ['key' => 'user_key', 'type' => 'secret', 'label' => 'User Key', 'required' => true],
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

            $service = new PushoverService(
                apiKey: $creds->get('pushover', 'api_key', '', $account),
                userKey: $creds->get('pushover', 'user_key', '', $account),
                baseUrl: $creds->get('pushover', 'url', 'https://api.pushover.net/1', $account),
            );

            return new $class($service);
        }

        return new $class(app(PushoverService::class));
    }
}
