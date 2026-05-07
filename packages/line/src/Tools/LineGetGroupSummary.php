<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get LINE group summary.
 *
 * Returns name, icon, and metadata for a group chat.
 */
class LineGetGroupSummary implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_group_summary';
    }

    public function description(): string
    {
        return 'Get LINE group chat summary information.';
    }

    public function parameters(): array
    {
        return ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE group ID.']];
    }

    /**
     * Get group summary.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getGroupSummary((string) ($args['group_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
