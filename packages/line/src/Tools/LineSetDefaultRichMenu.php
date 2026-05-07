<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Set LINE default rich menu.
 *
 * Applies a rich menu to all users by default.
 */
class LineSetDefaultRichMenu implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_set_default_rich_menu';
    }

    public function description(): string
    {
        return 'Set the default rich menu for all LINE users.';
    }

    public function parameters(): array
    {
        return ['rich_menu_id' => ['type' => 'string', 'required' => true, 'description' => 'Rich menu ID.']];
    }

    /**
     * Set default rich menu.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->setDefaultRichMenu((string) ($args['rich_menu_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
