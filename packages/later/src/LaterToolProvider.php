<?php

namespace OpenCompany\Integrations\Later;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Later\Tools\LaterListProfiles;
use OpenCompany\Integrations\Later\Tools\LaterGetProfile;
use OpenCompany\Integrations\Later\Tools\LaterListPosts;
use OpenCompany\Integrations\Later\Tools\LaterCreatePost;
use OpenCompany\Integrations\Later\Tools\LaterListMedia;
use OpenCompany\Integrations\Later\Tools\LaterGetMedia;
use OpenCompany\Integrations\Later\Tools\LaterGetCurrentUser;

class LaterToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'later';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'profiles, posts, scheduling, media',
            'description' => 'Social media scheduling',
            'icon' => 'ph:calendar-dots',
            'logo' => 'simple-icons:later',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Later',
            'description' => 'Social media scheduling platform — plan, schedule, and publish content across Instagram, Twitter, Facebook, Pinterest, TikTok, and more.',
            'icon' => 'ph:calendar-dots',
            'logo' => 'simple-icons:later',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developer.later.com/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Later access token',
                'hint' => 'Generate an access token from the Later developer settings or via OAuth 2.0',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.later.com/v1',
                'hint' => 'Use <code>https://api.later.com/v1</code> for the standard API, or a custom URL if applicable',
                'default' => 'https://api.later.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.later.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Later API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Later API returned an error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $name = trim(($json['name'] ?? '') . ' ' . ($json['email'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Later API" . ($name ? " as {$name}" : '') . ".",
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
            'later_list_profiles' => [
                'class' => LaterListProfiles::class,
                'type' => 'read',
                'name' => 'List Profiles',
                'description' => 'List all social media profiles connected to Later.',
                'icon' => 'ph:users',
            ],
            'later_get_profile' => [
                'class' => LaterGetProfile::class,
                'type' => 'read',
                'name' => 'Get Profile',
                'description' => 'Get details of a specific social profile.',
                'icon' => 'ph:user',
            ],
            'later_list_posts' => [
                'class' => LaterListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List scheduled and published posts.',
                'icon' => 'ph:list-bullets',
            ],
            'later_create_post' => [
                'class' => LaterCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create and schedule a new social media post.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'later_list_media' => [
                'class' => LaterListMedia::class,
                'type' => 'read',
                'name' => 'List Media',
                'description' => 'List media items in the Later media library.',
                'icon' => 'ph:images',
            ],
            'later_get_media' => [
                'class' => LaterGetMedia::class,
                'type' => 'read',
                'name' => 'Get Media',
                'description' => 'Get details of a specific media item.',
                'icon' => 'ph:image',
            ],
            'later_get_current_user' => [
                'class' => LaterGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/later.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.later.com/v1'],
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

            $service = new LaterService(
                accessToken: $creds->get('later', 'access_token', '', $account),
                baseUrl: $creds->get('later', 'url', 'https://api.later.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(LaterService::class));
    }
}
