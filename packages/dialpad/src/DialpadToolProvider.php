<?php

namespace OpenCompany\Integrations\Dialpad;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Dialpad\Tools\DialpadListCalls;
use OpenCompany\Integrations\Dialpad\Tools\DialpadGetCall;
use OpenCompany\Integrations\Dialpad\Tools\DialpadListSms;
use OpenCompany\Integrations\Dialpad\Tools\DialpadSendSms;
use OpenCompany\Integrations\Dialpad\Tools\DialpadListUsers;
use OpenCompany\Integrations\Dialpad\Tools\DialpadGetUser;
use OpenCompany\Integrations\Dialpad\Tools\DialpadGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Tool provider for the Dialpad integration.
 *
 * Registers all Dialpad tools and provides integration metadata,
 * configuration schema, and credential definitions for the
 * OpenCompany integration ecosystem.
 */
class DialpadToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'dialpad';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'calls, sms, users',
            'description' => 'Business communications',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:dialpad',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Dialpad',
            'description' => 'AI-powered business phone system — calls, SMS, and contact management',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:dialpad',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developers.dialpad.com/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Dialpad API access token',
                'hint' => 'Generate an access token in your Dialpad admin settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://dialpad.com',
                'hint' => 'Use <code>https://dialpad.com</code> for the standard API, or a custom URL if applicable',
                'default' => 'https://dialpad.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://dialpad.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Dialpad API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            $userName = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Dialpad API" . ($userName ? " as {$userName}" : '') . ".",
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
            'dialpad_list_calls' => [
                'class' => DialpadListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List call history records.',
                'icon' => 'ph:phone',
            ],
            'dialpad_get_call' => [
                'class' => DialpadGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Get details of a specific call.',
                'icon' => 'ph:phone',
            ],
            'dialpad_list_sms' => [
                'class' => DialpadListSms::class,
                'type' => 'read',
                'name' => 'List SMS',
                'description' => 'List SMS messages.',
                'icon' => 'ph:chat-circle-text',
            ],
            'dialpad_send_sms' => [
                'class' => DialpadSendSms::class,
                'type' => 'write',
                'name' => 'Send SMS',
                'description' => 'Send an SMS message.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'dialpad_list_users' => [
                'class' => DialpadListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Dialpad users in the organization.',
                'icon' => 'ph:users',
            ],
            'dialpad_get_user' => [
                'class' => DialpadGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get details of a specific user.',
                'icon' => 'ph:user',
            ],
            'dialpad_get_current_user' => [
                'class' => DialpadGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/dialpad.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Dialpad API URL', 'required' => false, 'default' => 'https://dialpad.com'],
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

            $service = new DialpadService(
                accessToken: $creds->get('dialpad', 'access_token', '', $account),
                baseUrl: $creds->get('dialpad', 'url', 'https://dialpad.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(DialpadService::class));
    }
}
