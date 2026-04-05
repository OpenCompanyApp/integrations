<?php

namespace OpenCompany\Integrations\Vimeo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListVideos;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoUploadVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoDeleteVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListAlbums;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetAlbum;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListChannels;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetCurrentUser;

class VimeoToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'vimeo';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'videos, albums, channels',
            'description' => 'Video hosting & management',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:vimeo',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Vimeo',
            'description' => 'Video hosting, management, and streaming platform',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:vimeo',
            'category' => 'video',
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
                'placeholder' => 'Enter your Vimeo personal access token',
                'hint' => 'Generate a personal access token in your Vimeo account under <strong>Settings → API</strong> or via the <a href="https://developer.vimeo.com/apps" target="_blank">Vimeo Developer Portal</a>.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.vimeo.com',
                'hint' => 'Use <code>https://api.vimeo.com</code> unless you have a custom endpoint.',
                'default' => 'https://api.vimeo.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.vimeo.com', '/');

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
                    'error' => "Could not reach Vimeo API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Vimeo API returned an error: {$error}",
                ];
            }

            $name = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Vimeo as {$name}.",
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
            'vimeo_list_videos' => [
                'class' => VimeoListVideos::class,
                'type' => 'read',
                'name' => 'List Videos',
                'description' => 'List videos for the authenticated user.',
                'icon' => 'ph:video-camera',
            ],
            'vimeo_get_video' => [
                'class' => VimeoGetVideo::class,
                'type' => 'read',
                'name' => 'Get Video',
                'description' => 'Get details for a single video.',
                'icon' => 'ph:video-camera',
            ],
            'vimeo_upload_video' => [
                'class' => VimeoUploadVideo::class,
                'type' => 'write',
                'name' => 'Upload Video',
                'description' => 'Create an upload ticket for a new video.',
                'icon' => 'ph:upload-simple',
            ],
            'vimeo_delete_video' => [
                'class' => VimeoDeleteVideo::class,
                'type' => 'write',
                'name' => 'Delete Video',
                'description' => 'Delete a video permanently.',
                'icon' => 'ph:trash',
            ],
            'vimeo_list_albums' => [
                'class' => VimeoListAlbums::class,
                'type' => 'read',
                'name' => 'List Albums',
                'description' => 'List albums (showcases) for the authenticated user.',
                'icon' => 'ph:folder',
            ],
            'vimeo_get_album' => [
                'class' => VimeoGetAlbum::class,
                'type' => 'read',
                'name' => 'Get Album',
                'description' => 'Get details for a single album.',
                'icon' => 'ph:folder',
            ],
            'vimeo_list_channels' => [
                'class' => VimeoListChannels::class,
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List public Vimeo channels.',
                'icon' => 'ph:television',
            ],
            'vimeo_get_current_user' => [
                'class' => VimeoGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
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
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.vimeo.com'],
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

            $service = new VimeoService(
                accessToken: $creds->get('vimeo', 'access_token', '', $account),
                baseUrl: $creds->get('vimeo', 'url', 'https://api.vimeo.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(VimeoService::class));
    }
}
