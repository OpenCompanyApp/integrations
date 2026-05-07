<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * List LINE rich menus.
 *
 * Retrieves rich menus configured for the channel.
 */
class LineListRichMenus implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_list_rich_menus';
    }

    public function description(): string
    {
        return 'List LINE rich menus configured for the channel.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List rich menus.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->listRichMenus());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
