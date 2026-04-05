<?php

namespace OpenCompany\Integrations\Spotify\Tools;

use OpenCompany\Integrations\Spotify\SpotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpotifySearch implements Tool
{
    /**
     * Create a new SpotifySearch tool instance.
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
        return 'spotify_search';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Search for tracks, artists, albums, or playlists on Spotify. Returns matching items with basic metadata. Use specific get tools for detailed information about a single item.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string, enum?: array<string>}>
     */
    public function parameters(): array
    {
        return [
            'q' => ['type' => 'string', 'required' => true, 'description' => 'The search query (e.g., "Bohemian Rhapsody", "artist:Queen"). Supports Spotify search operators like artist:, album:, track:, year:, genre:.'],
            'type' => ['type' => 'string', 'description' => 'Type of results: "track", "artist", "album", or "playlist". Defaults to "track".', 'enum' => ['track', 'artist', 'album', 'playlist']],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results (default 20, max 50).'],
            'offset' => ['type' => 'integer', 'description' => 'The index of the first result (default 0, use for pagination).'],
        ];
    }

    /**
     * Execute the search tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The search results.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Spotify integration is not configured.');
            }

            $q = $args['q'];
            $type = $args['type'] ?? 'track';
            $limit = isset($args['limit']) ? min((int) $args['limit'], 50) : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->search($q, $type, $limit, $offset);

            return ToolResult::success($this->formatResponse($result, $type));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the search response into a clean, consistent structure.
     *
     * @param  array<string, mixed>  $result  The raw API response.
     * @param  string  $type  The search type.
     * @return array<string, mixed> The formatted response.
     */
    private function formatResponse(array $result, string $type): array
    {
        $key = $type . 's';
        $items = $result[$key]['items'] ?? [];

        $formatted = array_map(function (array $item) use ($type): array {
            $entry = [
                'id' => $item['id'] ?? null,
                'name' => $item['name'] ?? null,
                'uri' => $item['uri'] ?? null,
                'url' => $item['external_urls']['spotify'] ?? null,
            ];

            if ($type === 'track') {
                $entry['artists'] = array_map(fn (array $a) => ['id' => $a['id'] ?? null, 'name' => $a['name'] ?? null], $item['artists'] ?? []);
                $entry['album'] = isset($item['album']) ? [
                    'id' => $item['album']['id'] ?? null,
                    'name' => $item['album']['name'] ?? null,
                ] : null;
                $entry['duration_ms'] = $item['duration_ms'] ?? null;
                $entry['explicit'] = $item['explicit'] ?? false;
                $entry['popularity'] = $item['popularity'] ?? null;
            } elseif ($type === 'artist') {
                $entry['followers'] = $item['followers']['total'] ?? null;
                $entry['genres'] = $item['genres'] ?? [];
                $entry['popularity'] = $item['popularity'] ?? null;
            } elseif ($type === 'album') {
                $entry['artists'] = array_map(fn (array $a) => ['id' => $a['id'] ?? null, 'name' => $a['name'] ?? null], $item['artists'] ?? []);
                $entry['release_date'] = $item['release_date'] ?? null;
                $entry['total_tracks'] = $item['total_tracks'] ?? null;
            } elseif ($type === 'playlist') {
                $entry['description'] = $item['description'] ?? null;
                $entry['owner'] = $item['owner']['display_name'] ?? null;
                $entry['tracks_total'] = $item['tracks']['total'] ?? null;
                $entry['public'] = $item['public'] ?? null;
            }

            return $entry;
        }, $items);

        $response = [
            'query' => $result[$key]['href'] ?? null,
            'type' => $type,
            'items' => $formatted,
            'total' => $result[$key]['total'] ?? count($formatted),
        ];

        if (isset($result[$key]['next'])) {
            $response['has_more'] = true;
        }

        return $response;
    }
}
