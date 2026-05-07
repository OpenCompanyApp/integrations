<?php

namespace OpenCompany\Integrations\HeyGen;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenListVideos;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenGetVideo;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenCreateVideo;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenListAvatars;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenListVoices;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenGetCurrentUser;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenListTemplates;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class HeyGenToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'heygen';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'HeyGen',
            'description' => 'AI video generation',
            'icon' => 'ph:video',
            'logo' => 'simple-icons:heygen',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'HeyGen',
            'description' => 'AI-powered video generation with talking avatars',
            'icon' => 'ph:video',
            'logo' => 'simple-icons:heygen',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.heygen.com/reference/api-reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your HeyGen API token',
                'hint' => 'Generate an API token in your HeyGen account settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.heygen.com',
                'hint' => 'Use <code>https://api.heygen.com</code> for the standard API, or a custom endpoint if applicable',
                'default' => 'https://api.heygen.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.heygen.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/user.info');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach HeyGen API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "HeyGen API error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to HeyGen API at {$baseUrl}.",
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
            'heygen_list_videos' => [
                'class' => HeyGenListVideos::class,
                'type' => 'read',
                'name' => 'List Videos',
                'description' => 'List generated videos with pagination.',
                'icon' => 'ph:video',
            ],
            'heygen_get_video' => [
                'class' => HeyGenGetVideo::class,
                'type' => 'read',
                'name' => 'Get Video',
                'description' => 'Get the status and details of a specific video.',
                'icon' => 'ph:video-camera',
            ],
            'heygen_create_video' => [
                'class' => HeyGenCreateVideo::class,
                'type' => 'write',
                'name' => 'Create Video',
                'description' => 'Generate a new AI video with avatars and voices.',
                'icon' => 'ph:plus-circle',
            ],
            'heygen_list_avatars' => [
                'class' => HeyGenListAvatars::class,
                'type' => 'read',
                'name' => 'List Avatars',
                'description' => 'List all available talking avatars.',
                'icon' => 'ph:user-circle',
            ],
            'heygen_list_voices' => [
                'class' => HeyGenListVoices::class,
                'type' => 'read',
                'name' => 'List Voices',
                'description' => 'List all available voices for video generation.',
                'icon' => 'ph:speaker-high',
            ],
            'heygen_get_current_user' => [
                'class' => HeyGenGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account information.',
                'icon' => 'ph:user',
            ],
            'heygen_list_templates' => [
                'class' => HeyGenListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List available video templates with pagination.',
                'icon' => 'ph:layout',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/heygen.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.heygen.com'],
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

            $service = new HeyGenService(
                accessToken: $creds->get('heygen', 'access_token', '', $account),
                baseUrl: $creds->get('heygen', 'url', 'https://api.heygen.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(HeyGenService::class));
    }
}
