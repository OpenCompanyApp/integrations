<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * List LINE group member IDs.
 *
 * Retrieves member user IDs for a group chat.
 */
class LineListGroupMemberIds implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_list_group_member_ids';
    }

    public function description(): string
    {
        return 'List LINE group member user IDs.';
    }

    public function parameters(): array
    {
        return [
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE group ID.'],
            'start' => ['type' => 'string', 'description' => 'Continuation token.'],
        ];
    }

    /**
     * List group member IDs.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->listGroupMemberIds((string) ($args['group_id'] ?? ''), $args['start'] ?? null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
