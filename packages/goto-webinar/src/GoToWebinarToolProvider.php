<?php

namespace OpenCompany\Integrations\GoToWebinar;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarListWebinars;
use OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarGetWebinar;
use OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarCreateWebinar;
use OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarListSessions;
use OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarGetSession;
use OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarListPanelists;
use OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoToWebinarToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'goto-webinar';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'GoTo Webinar',
            'description' => 'Webinar management',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:goto',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'GoTo Webinar',
            'description' => 'Host and manage webinars, sessions, and panelists',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:goto',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developer.goto.com/GoToWebinarV2',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your GoTo Webinar access token',
                'hint' => 'Generate an access token from your GoTo developer account or OAuth flow',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getgo.com',
                'hint' => 'Use <code>https://api.getgo.com</code> for production, or your custom API URL',
                'default' => 'https://api.getgo.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.getgo.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach GoTo Webinar API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}): " . ($json['description'] ?? $json['error'] ?? 'Unknown error'),
                ];
            }

            $name = trim(($json['firstName'] ?? '') . ' ' . ($json['lastName'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to GoTo Webinar API as {$name}.",
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
            'gotowebinar_list_webinars' => [
                'class' => GoToWebinarListWebinars::class,
                'type' => 'read',
                'name' => 'List Webinars',
                'description' => 'List webinars with optional status filtering and pagination.',
                'icon' => 'ph:list',
            ],
            'gotowebinar_get_webinar' => [
                'class' => GoToWebinarGetWebinar::class,
                'type' => 'read',
                'name' => 'Get Webinar',
                'description' => 'Get details of a specific webinar.',
                'icon' => 'ph:video-camera',
            ],
            'gotowebinar_create_webinar' => [
                'class' => GoToWebinarCreateWebinar::class,
                'type' => 'write',
                'name' => 'Create Webinar',
                'description' => 'Schedule a new webinar with subject, time slots, and description.',
                'icon' => 'ph:plus',
            ],
            'gotowebinar_list_sessions' => [
                'class' => GoToWebinarListSessions::class,
                'type' => 'read',
                'name' => 'List Sessions',
                'description' => 'List sessions for a specific webinar.',
                'icon' => 'ph:list',
            ],
            'gotowebinar_get_session' => [
                'class' => GoToWebinarGetSession::class,
                'type' => 'read',
                'name' => 'Get Session',
                'description' => 'Get details of a specific webinar session.',
                'icon' => 'ph:video-camera',
            ],
            'gotowebinar_list_panelists' => [
                'class' => GoToWebinarListPanelists::class,
                'type' => 'read',
                'name' => 'List Panelists',
                'description' => 'List panelists for a specific webinar.',
                'icon' => 'ph:users',
            ],
            'gotowebinar_get_current_user' => [
                'class' => GoToWebinarGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/goto-webinar.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.getgo.com'],
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

            $service = new GoToWebinarService(
                accessToken: $creds->get('goto-webinar', 'access_token', '', $account),
                baseUrl: $creds->get('goto-webinar', 'url', 'https://api.getgo.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoToWebinarService::class));
    }
}
