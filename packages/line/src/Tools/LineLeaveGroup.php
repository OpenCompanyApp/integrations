<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Leave a LINE group chat.
 *
 * Removes the bot from the specified group.
 */
class LineLeaveGroup implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_leave_group';
    }

    public function description(): string
    {
        return 'Leave a LINE group chat.';
    }

    public function parameters(): array
    {
        return ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE group ID.']];
    }

    /**
     * Leave a group chat.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->leaveGroup((string) ($args['group_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
