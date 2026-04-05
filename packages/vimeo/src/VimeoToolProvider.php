<?php

namespace OpenCompany\Integrations\Vimeo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vimeo\Tools\VimeoCreateVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetCurrentUser;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListAlbums;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListFolders;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListVideos;

/**
 * Tool provider for the Vimeo video integration.
 *
 * Declares 6 tools for video management, album browsing, folder listing,
 * and user profile retrieval. Implements ConfigurableIntegration for
 * settings UI and multi-account support via createTool().
 */
class VimeoToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'vimeo';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'videos, albums, folders',
            'description' => 'Video hosting',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:vimeo',
        ];
    }

    // ── ConfigurableIntegration ───────────────────────────

    public function integrationMeta(): array
    {
        return [
            'name' => 'Vimeo',
            'description' => 'Video hosting, albums, and folder management',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:vimeo',
            'category' => 'media',
            'badge' => 'verified',
            'docs_url' => 'https://developer.vimeo.com/api/reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Vimeo access token',
                'hint' => 'Generate a personal access token at <a href="https://developer.vimeo.com/apps" target="_blank">developer.vimeo.com/apps</a> with the scopes you need (public, private, create, edit, delete, interact, upload, stats).',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.vimeo.com',
                'hint' => 'Change only if using a Vimeo API proxy or compatible alternative.',
                'default' => 'https://api.vimeo.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.vimeo.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            if ($response->successful()) {
                $name = $response->json('name') ?? 'Unknown';
                $uri = $response->json('uri') ?? '';

                return [
                    'success' => true,
                    'message' => "Connected to Vimeo as {$name} ({$uri}).",
                ];
            }

            $error = $response->json('error') ?? $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Vimeo API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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

    // ── Tools ─────────────────────────────────────────────

    public function tools(): array
    {
        return [
            'vimeo_list_videos' => [
                'class' => VimeoListVideos::class,
                'type' => 'read',
                'name' => 'List Videos',
                'description' => 'List videos for the authenticated user with pagination, query, and filters.',
                'icon' => 'ph:video-camera',
            ],
            'vimeo_get_video' => [
                'class' => VimeoGetVideo::class,
                'type' => 'read',
                'name' => 'Get Video',
                'description' => 'Get details for a single video by ID.',
                'icon' => 'ph:video-camera',
            ],
            'vimeo_create_video' => [
                'class' => VimeoCreateVideo::class,
                'type' => 'write',
                'name' => 'Create Video',
                'description' => 'Create a new video upload slot on Vimeo.',
                'icon' => 'ph:plus-circle',
            ],
            'vimeo_list_albums' => [
                'class' => VimeoListAlbums::class,
                'type' => 'read',
                'name' => 'List Albums',
                'description' => 'List albums (showcases) for the authenticated user.',
                'icon' => 'ph:folders',
            ],
            'vimeo_list_folders' => [
                'class' => VimeoListFolders::class,
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List folders (projects) for the authenticated user.',
                'icon' => 'ph:folder',
            ],
            'vimeo_get_current_user' => [
                'class' => VimeoGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s Vimeo profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/vimeo.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.vimeo.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Runtime context, may contain 'account' for multi-account
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the VimeoService, with optional account-specific credentials.
     *
     * When $context['account'] is set, creates a fresh service with that
     * account's credentials. Otherwise uses the container singleton.
     *
     * @param  array<string, mixed>  $context  Runtime context
     */
    private function resolveService(array $context = []): VimeoService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new VimeoService(
                accessToken: $creds->get('vimeo', 'access_token', '', $account),
                baseUrl: $creds->get('vimeo', 'base_url', 'https://api.vimeo.com', $account),
            );
        }

        return app(VimeoService::class);
    }
}
