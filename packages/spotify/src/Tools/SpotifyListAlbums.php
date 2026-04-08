<?php

namespace OpenCompany\Integrations\Spotify\Tools;

use OpenCompany\Integrations\Spotify\SpotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpotifyListAlbums implements Tool
{
    /**
     * Create a new SpotifyListAlbums tool instance.
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
        return 'spotify_list_albums';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'List albums by a specific Spotify artist. Includes singles and compilations by default.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Spotify artist ID.'],
            'include_groups' => ['type' => 'string', 'description' => 'Album types to include, comma-separated: "album", "single", "appears_on", "compilation". Defaults to "album,single".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of albums to return (default 20, max 50).'],
            'offset' => ['type' => 'integer', 'description' => 'The index of the first album (default 0, use for pagination).'],
        ];
    }

    /**
     * Execute the list albums tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The albums list.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Spotify integration is not configured.');
            }

            $id = $args['id'];
            $includeGroups = $args['include_groups'] ?? 'album,single';
            $limit = isset($args['limit']) ? min((int) $args['limit'], 50) : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listAlbums($id, $includeGroups, $limit, $offset);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the albums response into a clean structure.
     *
     * @param  array<string, mixed>  $result  The raw API response.
     * @return array<string, mixed> The formatted albums list.
     */
    private function formatResponse(array $result): array
    {
        $items = $result['items'] ?? [];

        $albums = array_map(function (array $item): array {
            return [
                'id' => $item['id'] ?? null,
                'name' => $item['name'] ?? null,
                'album_type' => $item['album_type'] ?? null,
                'release_date' => $item['release_date'] ?? null,
                'total_tracks' => $item['total_tracks'] ?? null,
                'url' => $item['external_urls']['spotify'] ?? null,
                'uri' => $item['uri'] ?? null,
                'artists' => array_map(fn (array $a) => [
                    'id' => $a['id'] ?? null,
                    'name' => $a['name'] ?? null,
                ], $item['artists'] ?? []),
            ];
        }, $items);

        $response = [
            'albums' => $albums,
            'total' => $result['total'] ?? count($albums),
        ];

        if (isset($result['next'])) {
            $response['has_more'] = true;
        }

        return $response;
    }
}
