<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * Get public Gotify server version information.
 */
class GotifyGetVersion implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_get_version';
    }

    public function description(): string
    {
        return 'Get Gotify server version information from the public /version endpoint.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch Gotify server version.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->service->getVersion());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
