<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get a LINE group member profile.
 *
 * Retrieves profile information for a user in a group that the bot can access.
 */
class LineGetGroupMemberProfile implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_group_member_profile';
    }

    public function description(): string
    {
        return 'Get profile information for a LINE group member.';
    }

    public function parameters(): array
    {
        return [
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE group ID.'],
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE user ID.'],
        ];
    }

    /**
     * Get group member profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getGroupMemberProfile((string) ($args['group_id'] ?? ''), (string) ($args['user_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
