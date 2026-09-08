<?php

namespace OpenCompany\Integrations\Facebook;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Facebook\Tools\FacebookListPages;
use OpenCompany\Integrations\Facebook\Tools\FacebookGetPage;
use OpenCompany\Integrations\Facebook\Tools\FacebookListPosts;
use OpenCompany\Integrations\Facebook\Tools\FacebookCreatePost;
use OpenCompany\Integrations\Facebook\Tools\FacebookGetPost;
use OpenCompany\Integrations\Facebook\Tools\FacebookListInsights;
use OpenCompany\Integrations\Facebook\Tools\FacebookGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FacebookToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'facebook';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Facebook',
            'description' => 'Social media management',
            'icon' => 'ph:facebook-logo',
            'logo' => 'simple-icons:facebook',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Facebook',
            'description' => 'Manage Facebook Pages, publish posts, and view page insights via the Graph API.',
            'icon' => 'ph:facebook-logo',
            'logo' => 'simple-icons:facebook',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.facebook.com/docs/graph-api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Facebook Page access token',
                'hint' => 'A long-lived Page access token with <code>pages_manage_posts</code>, <code>pages_read_engagement</code>, and <code>pages_read_user_content</code> permissions.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Graph API Base URL',
                'placeholder' => 'https://graph.facebook.com/v21.0',
                'hint' => 'The Facebook Graph API base URL including the API version.',
                'default' => 'https://graph.facebook.com/v21.0',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://graph.facebook.com/v21.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->timeout(10)->get($baseUrl . '/me', [
                'access_token' => $accessToken,
                'fields' => 'id,name',
            ]);

            $json = $response->json();

            if (isset($json['error'])) {
                return [
                    'success' => false,
                    'error' => $json['error']['message'] ?? 'Unknown Facebook API error.',
                ];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Facebook Graph API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Facebook as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'facebook_list_pages' => [
                'class' => FacebookListPages::class,
                'type' => 'read',
                'name' => 'List Pages',
                'description' => 'List all Facebook Pages the authenticated user manages.',
                'icon' => 'ph:facebook-logo',
            ],
            'facebook_get_page' => [
                'class' => FacebookGetPage::class,
                'type' => 'read',
                'name' => 'Get Page',
                'description' => 'Get details for a specific Facebook Page.',
                'icon' => 'ph:facebook-logo',
            ],
            'facebook_list_posts' => [
                'class' => FacebookListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List posts published by a Facebook Page.',
                'icon' => 'ph:note',
            ],
            'facebook_create_post' => [
                'class' => FacebookCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Publish a new post on a Facebook Page.',
                'icon' => 'ph:pencil-simple',
            ],
            'facebook_get_post' => [
                'class' => FacebookGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Get details for a specific Facebook post.',
                'icon' => 'ph:note',
            ],
            'facebook_list_insights' => [
                'class' => FacebookListInsights::class,
                'type' => 'read',
                'name' => 'List Insights',
                'description' => 'Get engagement and performance metrics for a Facebook Page.',
                'icon' => 'ph:chart-bar',
            ],
            'facebook_get_current_user' => [
                'class' => FacebookGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s Facebook profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/facebook.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Graph API Base URL', 'required' => false, 'default' => 'https://graph.facebook.com/v21.0'],
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

            $service = new FacebookService(
                accessToken: $creds->get('facebook', 'access_token', '', $account),
                baseUrl: $creds->get('facebook', 'base_url', 'https://graph.facebook.com/v21.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(FacebookService::class));
    }
}
