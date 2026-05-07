<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get member count for a LINE group chat.
 *
 * Returns the number of members in a group that the bot is a member of.
 */
class LineGetGroupMemberCount implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_group_member_count';
    }

    public function description(): string
    {
        return 'Get member count for a LINE group chat.';
    }

    public function parameters(): array
    {
        return ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE group ID.']];
    }

    /**
     * Get group member count.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getGroupMemberCount((string) ($args['group_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
