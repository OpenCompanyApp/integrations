<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get the default LINE rich menu.
 *
 * Returns the rich menu ID configured as the account default.
 */
class LineGetDefaultRichMenu implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_default_rich_menu';
    }

    public function description(): string
    {
        return 'Get the default LINE rich menu ID.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get default rich menu.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getDefaultRichMenu());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
