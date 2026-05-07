<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get LINE message delivery count.
 *
 * Supports reply, push, multicast, and broadcast delivery-count endpoints.
 */
class LineGetDeliveryCount implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_delivery_count';
    }

    public function description(): string
    {
        return 'Get number of sent LINE messages for reply, push, multicast, or broadcast on a date.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Delivery type: reply, push, multicast, or broadcast.'],
            'date' => ['type' => 'string', 'required' => true, 'description' => 'Date in yyyyMMdd format.'],
        ];
    }

    /**
     * Get delivery count.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getMessageDelivery((string) ($args['type'] ?? ''), (string) ($args['date'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
