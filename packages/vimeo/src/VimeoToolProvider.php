<?php

namespace OpenCompany\Integrations\Vimeo;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vimeo\Tools\VimeoAddVideoToAlbum;
use OpenCompany\Integrations\Vimeo\Tools\VimeoApiDelete;
use OpenCompany\Integrations\Vimeo\Tools\VimeoApiGet;
use OpenCompany\Integrations\Vimeo\Tools\VimeoApiPatch;
use OpenCompany\Integrations\Vimeo\Tools\VimeoApiPost;
use OpenCompany\Integrations\Vimeo\Tools\VimeoCreateAlbum;
use OpenCompany\Integrations\Vimeo\Tools\VimeoCreateFolder;
use OpenCompany\Integrations\Vimeo\Tools\VimeoCreateVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoCreateVideoComment;
use OpenCompany\Integrations\Vimeo\Tools\VimeoCreateVideoTextTrack;
use OpenCompany\Integrations\Vimeo\Tools\VimeoDeleteVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetAlbum;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetCurrentUser;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListAlbumVideos;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListAlbums;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListCategories;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListChannels;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListFolders;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListVideoComments;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListVideoPictures;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListVideoTextTracks;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListVideos;
use OpenCompany\Integrations\Vimeo\Tools\VimeoUpdateAlbum;
use OpenCompany\Integrations\Vimeo\Tools\VimeoUpdateFolder;
use OpenCompany\Integrations\Vimeo\Tools\VimeoUpdateVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoUploadVideo;

/**
 * Exposes Vimeo tools and credential metadata to host applications.
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Vimeo OAuth access tokens are sent as bearer tokens.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
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
            'description' => 'Manage Vimeo videos, uploads, albums, folders, channels, comments, text tracks, thumbnails, and categories.',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:vimeo',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.vimeo.com/api/reference',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify the access token by fetching the authenticated user.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = trim((string) ($config['access_token'] ?? ''));

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        try {
            $service = new VimeoService(
                accessToken: $accessToken,
                baseUrl: (string) ($config['base_url'] ?? 'https://api.vimeo.com'),
            );
            $service->getCurrentUser();

            return ['success' => true, 'message' => 'Connected to Vimeo API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'vimeo_list_videos' => ['class' => VimeoListVideos::class, 'type' => 'read', 'name' => 'List Videos', 'description' => 'List videos for the authenticated user.', 'icon' => 'ph:list'],
            'vimeo_get_video' => ['class' => VimeoGetVideo::class, 'type' => 'read', 'name' => 'Get Video', 'description' => 'Get a video by ID.', 'icon' => 'ph:video'],
            'vimeo_create_video' => ['class' => VimeoCreateVideo::class, 'type' => 'write', 'name' => 'Create Video', 'description' => 'Create a video upload resource.', 'icon' => 'ph:plus-circle'],
            'vimeo_upload_video' => ['class' => VimeoUploadVideo::class, 'type' => 'write', 'name' => 'Upload Video', 'description' => 'Create an upload ticket.', 'icon' => 'ph:upload'],
            'vimeo_update_video' => ['class' => VimeoUpdateVideo::class, 'type' => 'write', 'name' => 'Update Video', 'description' => 'Update a video.', 'icon' => 'ph:pencil-simple'],
            'vimeo_delete_video' => ['class' => VimeoDeleteVideo::class, 'type' => 'write', 'name' => 'Delete Video', 'description' => 'Delete a video.', 'icon' => 'ph:trash'],
            'vimeo_list_video_comments' => ['class' => VimeoListVideoComments::class, 'type' => 'read', 'name' => 'List Video Comments', 'description' => 'List comments for a video.', 'icon' => 'ph:chat-circle'],
            'vimeo_create_video_comment' => ['class' => VimeoCreateVideoComment::class, 'type' => 'write', 'name' => 'Create Video Comment', 'description' => 'Create a video comment.', 'icon' => 'ph:chat-circle-text'],
            'vimeo_list_video_text_tracks' => ['class' => VimeoListVideoTextTracks::class, 'type' => 'read', 'name' => 'List Video Text Tracks', 'description' => 'List video captions and subtitles.', 'icon' => 'ph:subtitles'],
            'vimeo_create_video_text_track' => ['class' => VimeoCreateVideoTextTrack::class, 'type' => 'write', 'name' => 'Create Video Text Track', 'description' => 'Create a video text track.', 'icon' => 'ph:subtitles'],
            'vimeo_list_video_pictures' => ['class' => VimeoListVideoPictures::class, 'type' => 'read', 'name' => 'List Video Pictures', 'description' => 'List video thumbnails.', 'icon' => 'ph:image'],
            'vimeo_list_albums' => ['class' => VimeoListAlbums::class, 'type' => 'read', 'name' => 'List Albums', 'description' => 'List albums/showcases.', 'icon' => 'ph:images'],
            'vimeo_get_album' => ['class' => VimeoGetAlbum::class, 'type' => 'read', 'name' => 'Get Album', 'description' => 'Get an album/showcase.', 'icon' => 'ph:images'],
            'vimeo_create_album' => ['class' => VimeoCreateAlbum::class, 'type' => 'write', 'name' => 'Create Album', 'description' => 'Create an album/showcase.', 'icon' => 'ph:plus-circle'],
            'vimeo_update_album' => ['class' => VimeoUpdateAlbum::class, 'type' => 'write', 'name' => 'Update Album', 'description' => 'Update an album/showcase.', 'icon' => 'ph:pencil-simple'],
            'vimeo_list_album_videos' => ['class' => VimeoListAlbumVideos::class, 'type' => 'read', 'name' => 'List Album Videos', 'description' => 'List videos in an album/showcase.', 'icon' => 'ph:list'],
            'vimeo_add_video_to_album' => ['class' => VimeoAddVideoToAlbum::class, 'type' => 'write', 'name' => 'Add Video To Album', 'description' => 'Add a video to an album/showcase.', 'icon' => 'ph:plus'],
            'vimeo_list_folders' => ['class' => VimeoListFolders::class, 'type' => 'read', 'name' => 'List Folders', 'description' => 'List folders/projects.', 'icon' => 'ph:folders'],
            'vimeo_create_folder' => ['class' => VimeoCreateFolder::class, 'type' => 'write', 'name' => 'Create Folder', 'description' => 'Create a folder/project.', 'icon' => 'ph:folder-plus'],
            'vimeo_update_folder' => ['class' => VimeoUpdateFolder::class, 'type' => 'write', 'name' => 'Update Folder', 'description' => 'Update a folder/project.', 'icon' => 'ph:pencil-simple'],
            'vimeo_list_channels' => ['class' => VimeoListChannels::class, 'type' => 'read', 'name' => 'List Channels', 'description' => 'List public channels.', 'icon' => 'ph:television'],
            'vimeo_list_categories' => ['class' => VimeoListCategories::class, 'type' => 'read', 'name' => 'List Categories', 'description' => 'List Vimeo categories.', 'icon' => 'ph:tag'],
            'vimeo_get_current_user' => ['class' => VimeoGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Vimeo user.', 'icon' => 'ph:user-circle'],
            'vimeo_api_get' => ['class' => VimeoApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a documented GET endpoint.', 'icon' => 'ph:terminal-window'],
            'vimeo_api_post' => ['class' => VimeoApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a documented POST endpoint.', 'icon' => 'ph:terminal-window'],
            'vimeo_api_patch' => ['class' => VimeoApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a documented PATCH endpoint.', 'icon' => 'ph:terminal-window'],
            'vimeo_api_delete' => ['class' => VimeoApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a documented DELETE endpoint.', 'icon' => 'ph:terminal-window'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/vimeo.md';
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

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Vimeo service for the default or selected account.
     *
     * @param  array<string, mixed>  $context  Runtime context.
     */
    private function resolveService(array $context = []): VimeoService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new VimeoService(
                accessToken: $creds->get('vimeo', 'access_token', '', $account),
                baseUrl: $creds->get('vimeo', 'base_url', 'https://api.vimeo.com', $account),
            );
        }

        return app(VimeoService::class);
    }
}
