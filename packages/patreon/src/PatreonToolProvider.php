<?php

namespace OpenCompany\Integrations\Patreon;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Patreon\Tools\PatreonListCampaigns;
use OpenCompany\Integrations\Patreon\Tools\PatreonGetCampaign;
use OpenCompany\Integrations\Patreon\Tools\PatreonListMembers;
use OpenCompany\Integrations\Patreon\Tools\PatreonGetMember;
use OpenCompany\Integrations\Patreon\Tools\PatreonListPosts;
use OpenCompany\Integrations\Patreon\Tools\PatreonGetPost;
use OpenCompany\Integrations\Patreon\Tools\PatreonGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PatreonToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'patreon';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Patreon',
            'description' => 'Creator platform',
            'icon' => 'ph:heart',
            'logo' => 'simple-icons:patreon',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Patreon',
            'description' => 'Manage your Patreon creator campaigns, members, and posts',
            'icon' => 'ph:heart',
            'logo' => 'simple-icons:patreon',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.patreon.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Patreon access token',
                'hint' => 'Create a client and obtain an access token from the <strong>Patreon Developer Portal</strong>.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.patreon.com/api/oauth2/v2',
                'hint' => 'Use the default Patreon API URL. Only change if using a custom endpoint.',
                'default' => 'https://www.patreon.com/api/oauth2/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://www.patreon.com/api/oauth2/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/identity');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Patreon API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Patreon API error: {$error}",
                ];
            }

            $displayName = $json['data']['attributes']['full_name'] ?? ($json['data']['attributes']['email'] ?? 'unknown');

            return [
                'success' => true,
                'message' => "Connected to Patreon API as {$displayName}.",
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
            'patreon_list_campaigns' => [
                'class' => PatreonListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List all campaigns for the authenticated creator.',
                'icon' => 'ph:flag',
            ],
            'patreon_get_campaign' => [
                'class' => PatreonGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details for a single campaign.',
                'icon' => 'ph:flag',
            ],
            'patreon_list_members' => [
                'class' => PatreonListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List members (patrons) for a campaign.',
                'icon' => 'ph:users',
            ],
            'patreon_get_member' => [
                'class' => PatreonGetMember::class,
                'type' => 'read',
                'name' => 'Get Member',
                'description' => 'Get details for a single member.',
                'icon' => 'ph:user',
            ],
            'patreon_list_posts' => [
                'class' => PatreonListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List posts for a campaign.',
                'icon' => 'ph:article',
            ],
            'patreon_get_post' => [
                'class' => PatreonGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Get details for a single post.',
                'icon' => 'ph:article',
            ],
            'patreon_get_current_user' => [
                'class' => PatreonGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/patreon.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://www.patreon.com/api/oauth2/v2'],
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

            $service = new PatreonService(
                accessToken: $creds->get('patreon', 'access_token', '', $account),
                baseUrl: $creds->get('patreon', 'url', 'https://www.patreon.com/api/oauth2/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(PatreonService::class));
    }
}
