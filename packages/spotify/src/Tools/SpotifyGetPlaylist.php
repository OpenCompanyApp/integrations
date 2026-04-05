<?php

namespace OpenCompany\Integrations\Spotify\Tools;

use OpenCompany\Integrations\Spotify\SpotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpotifyGetPlaylist implements Tool
{
    /**
     * Create a new SpotifyGetPlaylist tool instance.
     *
     * @param  SpotifyService  $service  The Spotify service for making API calls.
     */
    public function __construct(
        private SpotifyService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'spotify_get_playlist';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get detailed information about a Spotify playlist, including its tracks with artist and album details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Spotify playlist ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tracks to return (default 20, max 100).'],
            'offset' => ['type' => 'integer', 'description' => 'The index of the first track (default 0, use for pagination).'],
        ];
    }

    /**
     * Execute the get playlist tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The playlist details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Spotify integration is not configured.');
            }

            $id = $args['id'];
            $limit = isset($args['limit']) ? min((int) $args['limit'], 100) : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->getPlaylist($id, $limit, $offset);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the playlist response into a clean structure.
     *
     * @param  array<string, mixed>  $playlist  The raw API response.
     * @return array<string, mixed> The formatted playlist details.
     */
    private function formatResponse(array $playlist): array
    {
        $tracks = array_map(function (array $item): array {
            $track = $item['track'] ?? [];

            return [
                'added_at' => $item['added_at'] ?? null,
                'id' => $track['id'] ?? null,
                'name' => $track['name'] ?? null,
                'uri' => $track['uri'] ?? null,
                'duration_ms' => $track['duration_ms'] ?? null,
                'explicit' => $track['explicit'] ?? false,
                'artists' => array_map(fn (array $a) => [
                    'id' => $a['id'] ?? null,
                    'name' => $a['name'] ?? null,
                ], $track['artists'] ?? []),
                'album' => isset($track['album']) ? [
                    'id' => $track['album']['id'] ?? null,
                    'name' => $track['album']['name'] ?? null,
                ] : null,
            ];
        }, $playlist['tracks']['items'] ?? []);

        return [
            'id' => $playlist['id'] ?? null,
            'name' => $playlist['name'] ?? null,
            'description' => $playlist['description'] ?? null,
            'owner' => $playlist['owner']['display_name'] ?? null,
            'public' => $playlist['public'] ?? null,
            'url' => $playlist['external_urls']['spotify'] ?? null,
            'uri' => $playlist['uri'] ?? null,
            'tracks_total' => $playlist['tracks']['total'] ?? null,
            'tracks' => $tracks,
            'tracks_returned' => count($tracks),
            'has_more' => isset($playlist['tracks']['next']),
        ];
    }
}
