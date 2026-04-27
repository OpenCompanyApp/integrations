<?php

namespace OpenCompany\Integrations\SproutSocial;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SproutSocial\Tools\SproutSocialListProfiles;
use OpenCompany\Integrations\SproutSocial\Tools\SproutSocialGetProfile;
use OpenCompany\Integrations\SproutSocial\Tools\SproutSocialListPosts;
use OpenCompany\Integrations\SproutSocial\Tools\SproutSocialCreatePost;
use OpenCompany\Integrations\SproutSocial\Tools\SproutSocialListMessages;
use OpenCompany\Integrations\SproutSocial\Tools\SproutSocialGetMessage;
use OpenCompany\Integrations\SproutSocial\Tools\SproutSocialGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SproutSocialToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'sproutsocial';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'profiles, posts, messages',
            'description' => 'Social media management',
            'icon' => 'ph:chat-centered-dots',
            'logo' => 'simple-icons:sproutsocial',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Sprout Social',
            'description' => 'Social media management platform — schedule posts, manage social profiles, engage with messages, and analyze performance across multiple accounts.',
            'icon' => 'ph:chat-centered-dots',
            'logo' => 'simple-icons:sproutsocial',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.sproutsocial.com/docs/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Sprout Social access token',
                'hint' => 'Generate an access token from the Sprout Social developer settings or via OAuth 2.0',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.sproutsocial.com/v1',
                'hint' => 'Use <code>https://api.sproutsocial.com/v1</code> for the standard API, or a custom URL if applicable',
                'default' => 'https://api.sproutsocial.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.sproutsocial.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Sprout Social API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Sprout Social API returned an error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $name = trim(($json['name'] ?? '') . ' ' . ($json['email'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Sprout Social API" . ($name ? " as {$name}" : '') . ".",
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
            'sproutsocial_list_profiles' => [
                'class' => SproutSocialListProfiles::class,
                'type' => 'read',
                'name' => 'List Profiles',
                'description' => 'List all social media profiles connected to Sprout Social.',
                'icon' => 'ph:users',
            ],
            'sproutsocial_get_profile' => [
                'class' => SproutSocialGetProfile::class,
                'type' => 'read',
                'name' => 'Get Profile',
                'description' => 'Get details of a specific social profile.',
                'icon' => 'ph:user',
            ],
            'sproutsocial_list_posts' => [
                'class' => SproutSocialListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List posts across social profiles with optional status filtering.',
                'icon' => 'ph:newspaper',
            ],
            'sproutsocial_create_post' => [
                'class' => SproutSocialCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create and schedule a new social media post.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'sproutsocial_list_messages' => [
                'class' => SproutSocialListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List inbox messages and conversations.',
                'icon' => 'ph:envelope',
            ],
            'sproutsocial_get_message' => [
                'class' => SproutSocialGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get details of a specific message.',
                'icon' => 'ph:chat-text',
            ],
            'sproutsocial_get_current_user' => [
                'class' => SproutSocialGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/sproutsocial.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.sproutsocial.com/v1'],
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

            $service = new SproutSocialService(
                accessToken: $creds->get('sproutsocial', 'access_token', '', $account),
                baseUrl: $creds->get('sproutsocial', 'url', 'https://api.sproutsocial.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(SproutSocialService::class));
    }
}
