<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get the rich menu linked to a LINE user.
 *
 * Returns the per-user rich menu ID for the specified user.
 */
class LineGetUserRichMenu implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_user_rich_menu';
    }

    public function description(): string
    {
        return 'Get the rich menu linked to a LINE user.';
    }

    public function parameters(): array
    {
        return ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE user ID.']];
    }

    /**
     * Get linked rich menu for a user.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getUserRichMenu((string) ($args['user_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
