<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Delete a LINE rich menu.
 *
 * Removes a rich menu by rich menu ID.
 */
class LineDeleteRichMenu implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_delete_rich_menu';
    }

    public function description(): string
    {
        return 'Delete a LINE rich menu by ID.';
    }

    public function parameters(): array
    {
        return ['rich_menu_id' => ['type' => 'string', 'required' => true, 'description' => 'Rich menu ID.']];
    }

    /**
     * Delete rich menu.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->deleteRichMenu((string) ($args['rich_menu_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
