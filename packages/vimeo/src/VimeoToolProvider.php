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

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Vimeo\Tools\VimeoDeleteVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetAlbum;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListChannels;
use OpenCompany\Integrations\Vimeo\Tools\VimeoUploadVideo;

/**
 * Registers the integration provider and exposes its tools.
 */
class VimeoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'vimeo';
    }

public function appMeta(): array
    {
        return [
            'label' => 'Vimeo',
            'description' => 'Video hosting',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:vimeo',
        ];
    }

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
        return $this->credentialFields();
    }

    /**
     * Validate that required credentials were supplied for this integration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        foreach ($this->credentialFields() as $field) {
            if (($field['required'] ?? true) && empty($config[$field['key']])) {
                return [
                    'success' => false,
                    'error' => ($field['label'] ?? $field['key']) . ' is required.',
                ];
            }
        }

        return [
            'success' => true,
            'message' => 'Required credentials are configured. API access will be verified when tools run.',
        ];
    }
public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'base_url' => 'nullable|string',
        ];
    }

        public function tools(): array
    {
        return [
            'vimeo_create_video' => [
                'class' => VimeoCreateVideo::class,
                'type' => 'write',
                'name' => 'Create Video',
                'description' => 'Create a new video upload slot on Vimeo. Choose an upload approach: "pull" (Vimeo downloads from a URL), "post" (you POST to an upload link), or "streaming" (Tus protocol). Returns the video URI and upload target.',
                'icon' => 'ph:wrench',
            ],
            'vimeo_get_current_user' => [
                'class' => VimeoGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Vimeo user\'s profile information. Returns name, bio, location, account type, upload quota, and profile pictures.',
                'icon' => 'ph:wrench',
            ],
            'vimeo_get_video' => [
                'class' => VimeoGetVideo::class,
                'type' => 'read',
                'name' => 'Get Video',
                'description' => 'Get detailed information about a single Vimeo video by its ID. Returns name, description, duration, thumbnails, privacy, stats, and playback links.',
                'icon' => 'ph:wrench',
            ],
            'vimeo_list_albums' => [
                'class' => VimeoListAlbums::class,
                'type' => 'read',
                'name' => 'List Albums',
                'description' => 'List albums (showcases) for the authenticated Vimeo user. Supports pagination, query search, sorting, and direction. Returns album names, descriptions, thumbnails, and video counts.',
                'icon' => 'ph:wrench',
            ],
            'vimeo_list_folders' => [
                'class' => VimeoListFolders::class,
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List folders (projects) for the authenticated Vimeo user. Supports pagination and query search. Returns folder names, descriptions, and item counts.',
                'icon' => 'ph:wrench',
            ],
            'vimeo_list_videos' => [
                'class' => VimeoListVideos::class,
                'type' => 'read',
                'name' => 'List Videos',
                'description' => 'List videos for the authenticated Vimeo user. Supports pagination, full-text search via query, and filters (e.g., embeddable, playable, privacy). Returns video URIs, names, durations, thumbnails, and metadata.',
                'icon' => 'ph:wrench',
            ],
        ];
    }



    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/vimeo.md';
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
    {        return new $class($this->resolveService($context));
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
