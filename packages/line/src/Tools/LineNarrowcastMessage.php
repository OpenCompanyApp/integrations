<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Send LINE narrowcast messages.
 *
 * Targets recipients by audience and optional demographic filters.
 */
class LineNarrowcastMessage implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_narrowcast_message';
    }

    public function description(): string
    {
        return 'Send a narrowcast message with recipient and demographic filters.';
    }

    public function parameters(): array
    {
        return [
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of LINE message objects.'],
            'recipient' => ['type' => 'object', 'description' => 'Recipient object such as audienceGroupId include/exclude filters.'],
            'filter' => ['type' => 'object', 'description' => 'Demographic filter object.'],
            'notification_disabled' => ['type' => 'boolean', 'description' => 'Disable push notification when true.'],
        ];
    }

    /**
     * Send a narrowcast message.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->narrowcastMessage($args['messages'] ?? [], $args['recipient'] ?? [], $args['filter'] ?? [], (bool) ($args['notification_disabled'] ?? false)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
