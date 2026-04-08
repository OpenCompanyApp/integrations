<?php

namespace OpenCompany\Integrations\YouTube\Tools;

use OpenCompany\Integrations\YouTube\YouTubeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated user's YouTube channel information.
 */
class YouTubeGetCurrentUser implements Tool
{
    /** @param  YouTubeService  $service  The YouTube API client */
    public function __construct(
        private YouTubeService $service,
    ) {}

    public function name(): string
    {
        return 'youtube_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s YouTube channel information, including channel title, description, subscriber count, total views, and video count.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the authenticated user's channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('YouTube is not configured. Missing API key.');
        }

        try {
            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
