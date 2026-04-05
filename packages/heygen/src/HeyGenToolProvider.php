<?php

namespace OpenCompany\Integrations\HeyGen;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenCreateAvatar;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenCreateVideo;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenGetAvatar;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenGetCurrentUser;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenGetVideo;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenListAvatars;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenListVideos;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenListVoices;

/**
 * Tool provider for the HeyGen AI video generation integration.
 *
 * Implements ConfigurableIntegration for multi-account support, credential
 * management, connection testing, and tool registration. Provides eight tools
 * covering video generation, avatar management, voice listing, and user info.
 */
class HeyGenToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'heygen';
    }

    /**
     * Get short metadata for display in the tool registry.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'video, avatars, voices',
            'description' => 'AI video generation',
            'icon' => 'ph:video',
            'logo' => 'simple-icons:heygen',
        ];
    }

    /**
     * Get detailed integration metadata for the marketplace/UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'HeyGen',
            'description' => 'AI-powered video generation with customizable avatars and voices',
            'icon' => 'ph:video',
            'logo' => 'simple-icons:heygen',
            'category' => 'video',
            'badge' => 'verified',
            'docs_url' => 'https://docs.heygen.com/reference/api-reference',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your HeyGen API key',
                'hint' => 'Find your API key in HeyGen under Settings > API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.heygen.com/v2',
                'hint' => 'Use <code>https://api.heygen.com/v2</code> for the standard API',
                'default' => 'https://api.heygen.com/v2',
            ],
        ];
    }

    /**
     * Test the connection to the HeyGen API using the provided config.
     *
     * @param  array  $config  Configuration containing 'api_key' and optionally 'url'.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.heygen.com/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user/info');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach HeyGen API at {$baseUrl}. Check the URL.",
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

    /**
     * Get validation rules for the integration configuration.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'heygen_create_video' => [
                'class' => HeyGenCreateVideo::class,
                'type' => 'write',
                'name' => 'Create Video',
                'description' => 'Generate a new AI video with an avatar and voice.',
                'icon' => 'ph:video',
            ],
            'heygen_get_video' => [
                'class' => HeyGenGetVideo::class,
                'type' => 'read',
                'name' => 'Get Video',
                'description' => 'Get the status and details of a video.',
                'icon' => 'ph:play-circle',
            ],
            'heygen_list_videos' => [
                'class' => HeyGenListVideos::class,
                'type' => 'read',
                'name' => 'List Videos',
                'description' => 'List generated videos with pagination.',
                'icon' => 'ph:list',
            ],
            'heygen_list_avatars' => [
                'class' => HeyGenListAvatars::class,
                'type' => 'read',
                'name' => 'List Avatars',
                'description' => 'List available avatars for video generation.',
                'icon' => 'ph:user-circle',
            ],
            'heygen_get_avatar' => [
                'class' => HeyGenGetAvatar::class,
                'type' => 'read',
                'name' => 'Get Avatar',
                'description' => 'Get details of a specific avatar.',
                'icon' => 'ph:user-circle',
            ],
            'heygen_list_voices' => [
                'class' => HeyGenListVoices::class,
                'type' => 'read',
                'name' => 'List Voices',
                'description' => 'List available voices for video generation.',
                'icon' => 'ph:microphone',
            ],
            'heygen_create_avatar' => [
                'class' => HeyGenCreateAvatar::class,
                'type' => 'write',
                'name' => 'Create Avatar',
                'description' => 'Create a new custom avatar.',
                'icon' => 'ph:user-plus',
            ],
            'heygen_get_current_user' => [
                'class' => HeyGenGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file for this integration.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/heygen.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.heygen.com/v2'],
        ];
    }

    /**
     * Confirm this class represents an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class  The fully-qualified tool class name.
     * @param  array  $context  Optional context containing an 'account' key for multi-account support.
     * @return Tool The instantiated tool with the appropriate service.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new HeyGenService(
                apiKey: $creds->get('heygen', 'api_key', '', $account),
                baseUrl: $creds->get('heygen', 'url', 'https://api.heygen.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(HeyGenService::class));
    }
}
