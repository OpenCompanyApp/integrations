<?php

namespace OpenCompany\Integrations\Pinterest;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pinterest\Tools\PinterestListPins;
use OpenCompany\Integrations\Pinterest\Tools\PinterestGetPin;
use OpenCompany\Integrations\Pinterest\Tools\PinterestCreatePin;
use OpenCompany\Integrations\Pinterest\Tools\PinterestListBoards;
use OpenCompany\Integrations\Pinterest\Tools\PinterestGetBoard;
use OpenCompany\Integrations\Pinterest\Tools\PinterestListCampaigns;
use OpenCompany\Integrations\Pinterest\Tools\PinterestGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PinterestToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'pinterest';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Pinterest',
            'description' => 'Visual discovery and marketing',
            'icon' => 'ph:pinterest-logo',
            'logo' => 'simple-icons:pinterest',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pinterest',
            'description' => 'Visual discovery and marketing platform — manage pins, boards, and ad campaigns.',
            'icon' => 'ph:pinterest-logo',
            'logo' => 'simple-icons:pinterest',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.pinterest.com/docs/getting-started/introduction/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Pinterest access token',
                'hint' => 'Generate an access token from the Pinterest Developer portal or via OAuth 2.0',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pinterest.com/v5',
                'hint' => 'Use <code>https://api.pinterest.com/v5</code> for the standard API, or a custom URL if applicable',
                'default' => 'https://api.pinterest.com/v5',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.pinterest.com/v5', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user_account');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Pinterest API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Pinterest API returned an error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $username = $json['username'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to Pinterest API" . ($username ? " as {$username}" : '') . ".",
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
            'pinterest_list_pins' => [
                'class' => PinterestListPins::class,
                'type' => 'read',
                'name' => 'List Pins',
                'description' => 'List pins for the authenticated user.',
                'icon' => 'ph:push-pin',
            ],
            'pinterest_get_pin' => [
                'class' => PinterestGetPin::class,
                'type' => 'read',
                'name' => 'Get Pin',
                'description' => 'Get details of a specific pin.',
                'icon' => 'ph:push-pin',
            ],
            'pinterest_create_pin' => [
                'class' => PinterestCreatePin::class,
                'type' => 'write',
                'name' => 'Create Pin',
                'description' => 'Create a new pin on a board.',
                'icon' => 'ph:plus-circle',
            ],
            'pinterest_list_boards' => [
                'class' => PinterestListBoards::class,
                'type' => 'read',
                'name' => 'List Boards',
                'description' => 'List boards for the authenticated user.',
                'icon' => 'ph:squares-four',
            ],
            'pinterest_get_board' => [
                'class' => PinterestGetBoard::class,
                'type' => 'read',
                'name' => 'Get Board',
                'description' => 'Get details of a specific board.',
                'icon' => 'ph:squares-four',
            ],
            'pinterest_list_campaigns' => [
                'class' => PinterestListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List ad campaigns for an ad account.',
                'icon' => 'ph:megaphone',
            ],
            'pinterest_get_current_user' => [
                'class' => PinterestGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pinterest.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pinterest.com/v5'],
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

            $service = new PinterestService(
                accessToken: $creds->get('pinterest', 'access_token', '', $account),
                baseUrl: $creds->get('pinterest', 'url', 'https://api.pinterest.com/v5', $account),
            );

            return new $class($service);
        }

        return new $class(app(PinterestService::class));
    }
}
