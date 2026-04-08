<?php

namespace OpenCompany\Integrations\Spotify\Tools;

use OpenCompany\Integrations\Spotify\SpotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpotifyCreatePlaylist implements Tool
{
    /**
     * Create a new SpotifyCreatePlaylist tool instance.
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
        return 'spotify_create_playlist';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Create a new Spotify playlist for the current user. Use the "Get Current User" tool first if you need the user ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'The Spotify user ID. Get this from the "Get Current User" tool.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new playlist.'],
            'description' => ['type' => 'string', 'description' => 'An optional description for the playlist.'],
            'public' => ['type' => 'boolean', 'description' => 'Whether the playlist should be public (default true).'],
        ];
    }

    /**
     * Execute the create playlist tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The created playlist details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Spotify integration is not configured.');
            }

            $userId = $args['user_id'];
            $name = $args['name'];
            $description = $args['description'] ?? '';
            $public = $args['public'] ?? true;

            $result = $this->service->createPlaylist($userId, $name, $description, $public);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'name' => $result['name'] ?? null,
                'description' => $result['description'] ?? '',
                'public' => $result['public'] ?? true,
                'owner' => $result['owner']['display_name'] ?? null,
                'url' => $result['external_urls']['spotify'] ?? null,
                'uri' => $result['uri'] ?? null,
                'message' => "Playlist '{$name}' created successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
