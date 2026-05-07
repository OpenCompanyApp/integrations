<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get LINE message quota consumption.
 *
 * Returns how many messages were sent this month.
 */
class LineGetMessageQuotaConsumption implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_message_quota_consumption';
    }

    public function description(): string
    {
        return 'Get LINE message quota consumption for the current month.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get message quota consumption.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getMessageQuotaConsumption());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
