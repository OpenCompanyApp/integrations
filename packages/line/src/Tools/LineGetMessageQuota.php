<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get LINE monthly message quota.
 *
 * Returns the target limit for sending messages this month.
 */
class LineGetMessageQuota implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_message_quota';
    }

    public function description(): string
    {
        return 'Get the monthly LINE message quota limit.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get message quota.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getMessageQuota());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
