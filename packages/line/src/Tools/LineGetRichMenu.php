<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get a LINE rich menu.
 *
 * Retrieves rich menu metadata by rich menu ID.
 */
class LineGetRichMenu implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_rich_menu';
    }

    public function description(): string
    {
        return 'Get LINE rich menu metadata.';
    }

    public function parameters(): array
    {
        return ['rich_menu_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE rich menu ID.']];
    }

    /**
     * Get rich menu metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getRichMenu((string) ($args['rich_menu_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
