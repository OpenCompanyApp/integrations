<?php

namespace OpenCompany\Integrations\Spotify\Tools;

use OpenCompany\Integrations\Spotify\SpotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpotifyGetCurrentUser implements Tool
{
    /**
     * Create a new SpotifyGetCurrentUser tool instance.
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
        return 'spotify_get_current_user';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get the authenticated user\'s Spotify profile, including their user ID (needed for creating playlists), display name, and follower count.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, mixed> Empty — this tool takes no parameters.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     * @return ToolResult The user profile.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Spotify integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'display_name' => $result['display_name'] ?? null,
                'email' => $result['email'] ?? null,
                'followers' => $result['followers']['total'] ?? null,
                'country' => $result['country'] ?? null,
                'product' => $result['product'] ?? null,
                'url' => $result['external_urls']['spotify'] ?? null,
                'uri' => $result['uri'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
