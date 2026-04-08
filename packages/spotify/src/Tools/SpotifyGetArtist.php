<?php

namespace OpenCompany\Integrations\Spotify\Tools;

use OpenCompany\Integrations\Spotify\SpotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpotifyGetArtist implements Tool
{
    /**
     * Create a new SpotifyGetArtist tool instance.
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
        return 'spotify_get_artist';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Spotify artist, including followers, genres, and popularity.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Spotify artist ID (e.g., "1dfeR4HaWDbWqFHLkxsg1d").'],
        ];
    }

    /**
     * Execute the get artist tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The artist details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Spotify integration is not configured.');
            }

            $result = $this->service->getArtist($args['id']);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the artist response into a clean structure.
     *
     * @param  array<string, mixed>  $artist  The raw API response.
     * @return array<string, mixed> The formatted artist details.
     */
    private function formatResponse(array $artist): array
    {
        return [
            'id' => $artist['id'] ?? null,
            'name' => $artist['name'] ?? null,
            'uri' => $artist['uri'] ?? null,
            'url' => $artist['external_urls']['spotify'] ?? null,
            'followers' => $artist['followers']['total'] ?? null,
            'genres' => $artist['genres'] ?? [],
            'popularity' => $artist['popularity'] ?? null,
            'images' => array_map(fn (array $img) => [
                'url' => $img['url'] ?? null,
                'height' => $img['height'] ?? null,
                'width' => $img['width'] ?? null,
            ], $artist['images'] ?? []),
        ];
    }
}
