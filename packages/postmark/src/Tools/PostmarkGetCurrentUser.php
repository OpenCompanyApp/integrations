<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current Postmark server info.
 *
 * Returns server details including name, color, bounce hook URL, and delivery stats.
 */
class PostmarkGetCurrentUser implements Tool
{
    /**
     * @param  PostmarkService  $service  The Postmark API client
     */
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current Postmark server info including name, settings, and delivery stats. Useful as a health check.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the current Postmark server info.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $result = $this->service->getCurrentServer();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
