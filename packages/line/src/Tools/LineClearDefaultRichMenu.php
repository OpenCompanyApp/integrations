<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Clear the default LINE rich menu.
 *
 * Removes the rich menu assigned to all users by default.
 */
class LineClearDefaultRichMenu implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_clear_default_rich_menu';
    }

    public function description(): string
    {
        return 'Clear the default LINE rich menu.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Clear default rich menu.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->clearDefaultRichMenu());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
