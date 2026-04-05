<?php

namespace OpenCompany\Integrations\Spotify\Tools;

use OpenCompany\Integrations\Spotify\SpotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpotifyListPlaylists implements Tool
{
    /**
     * Create a new SpotifyListPlaylists tool instance.
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
        return 'spotify_list_playlists';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'List the current user\'s Spotify playlists. Returns playlist names, IDs, and track counts.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of playlists to return (default 20, max 50).'],
            'offset' => ['type' => 'integer', 'description' => 'The index of the first playlist (default 0, use for pagination).'],
        ];
    }

    /**
     * Execute the list playlists tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The playlists list.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Spotify integration is not configured.');
            }

            $limit = isset($args['limit']) ? min((int) $args['limit'], 50) : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listPlaylists($limit, $offset);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the playlists response into a clean structure.
     *
     * @param  array<string, mixed>  $result  The raw API response.
     * @return array<string, mixed> The formatted playlists.
     */
    private function formatResponse(array $result): array
    {
        $items = $result['items'] ?? [];

        $playlists = array_map(function (array $item): array {
            return [
                'id' => $item['id'] ?? null,
                'name' => $item['name'] ?? null,
                'description' => $item['description'] ?? null,
                'owner' => $item['owner']['display_name'] ?? null,
                'tracks_total' => $item['tracks']['total'] ?? null,
                'public' => $item['public'] ?? null,
                'url' => $item['external_urls']['spotify'] ?? null,
                'uri' => $item['uri'] ?? null,
            ];
        }, $items);

        $response = [
            'playlists' => $playlists,
            'total' => $result['total'] ?? count($playlists),
        ];

        if (isset($result['next'])) {
            $response['has_more'] = true;
        }

        return $response;
    }
}
