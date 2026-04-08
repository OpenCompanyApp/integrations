<?php

namespace OpenCompany\Integrations\Spotify\Tools;

use OpenCompany\Integrations\Spotify\SpotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpotifyGetTrack implements Tool
{
    /**
     * Create a new SpotifyGetTrack tool instance.
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
        return 'spotify_get_track';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Spotify track, including artists, album, duration, and popularity.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Spotify track ID (e.g., "4cOdK2wGLETKBW3PvgPWqT").'],
        ];
    }

    /**
     * Execute the get track tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The track details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Spotify integration is not configured.');
            }

            $result = $this->service->getTrack($args['id']);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the track response into a clean structure.
     *
     * @param  array<string, mixed>  $track  The raw API response.
     * @return array<string, mixed> The formatted track details.
     */
    private function formatResponse(array $track): array
    {
        return [
            'id' => $track['id'] ?? null,
            'name' => $track['name'] ?? null,
            'uri' => $track['uri'] ?? null,
            'url' => $track['external_urls']['spotify'] ?? null,
            'duration_ms' => $track['duration_ms'] ?? null,
            'explicit' => $track['explicit'] ?? false,
            'popularity' => $track['popularity'] ?? null,
            'track_number' => $track['track_number'] ?? null,
            'disc_number' => $track['disc_number'] ?? null,
            'preview_url' => $track['preview_url'] ?? null,
            'artists' => array_map(fn (array $a) => [
                'id' => $a['id'] ?? null,
                'name' => $a['name'] ?? null,
                'uri' => $a['uri'] ?? null,
            ], $track['artists'] ?? []),
            'album' => isset($track['album']) ? [
                'id' => $track['album']['id'] ?? null,
                'name' => $track['album']['name'] ?? null,
                'release_date' => $track['album']['release_date'] ?? null,
                'total_tracks' => $track['album']['total_tracks'] ?? null,
                'url' => $track['album']['external_urls']['spotify'] ?? null,
            ] : null,
        ];
    }
}
