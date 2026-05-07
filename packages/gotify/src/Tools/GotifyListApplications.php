<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * List Gotify applications visible to the configured client token.
 */
class GotifyListApplications implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_list_applications';
    }

    public function description(): string
    {
        return 'List Gotify applications visible to the configured client token.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List Gotify applications.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Listing applications requires a client token.');
            }

            return ToolResult::success($this->service->listApplications());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
