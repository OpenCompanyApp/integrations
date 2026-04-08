<?php

namespace OpenCompany\Integrations\YouTube\Tools;

use OpenCompany\Integrations\YouTube\YouTubeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details and items of a specific YouTube playlist.
 */
class YouTubeGetPlaylist implements Tool
{
    /** @param  YouTubeService  $service  The YouTube API client */
    public function __construct(
        private YouTubeService $service,
    ) {}

    public function name(): string
    {
        return 'youtube_get_playlist';
    }

    public function description(): string
    {
        return 'Get details about a specific YouTube playlist by ID, including its metadata and up to 50 playlist items (videos).';
    }

    public function parameters(): array
    {
        return [
            'playlist_id' => ['type' => 'string', 'required' => true, 'description' => 'The YouTube playlist ID (e.g., "PLrAXtmErZgOeiKm4sgNOknGvNjby9efdf").'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum playlist items to return (1-50). Default: 10.'],
            'page_token' => ['type' => 'string', 'description' => 'Token for the next page of playlist items.'],
        ];
    }

    /**
     * Get playlist details and items.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('YouTube is not configured. Missing API key.');
        }

        $playlistId = $args['playlist_id'] ?? '';

        if (empty($playlistId)) {
            return ToolResult::error('Playlist ID is required.');
        }

        try {
            // Get playlist metadata
            $playlist = $this->service->getPlaylist($playlistId);

            // Get playlist items
            $itemParams = [];
            if (isset($args['max_results'])) {
                $itemParams['maxResults'] = min(max((int) $args['max_results'], 1), 50);
            }
            if (isset($args['page_token'])) {
                $itemParams['pageToken'] = $args['page_token'];
            }

            $items = $this->service->listPlaylistItems($playlistId, $itemParams);

            $result = [
                'playlist' => $playlist,
                'items' => $items,
            ];

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
