<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Send LINE multicast messages.
 *
 * Delivers the same message set to multiple user IDs.
 */
class LineMulticastMessage implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_multicast_message';
    }

    public function description(): string
    {
        return 'Send messages to multiple LINE user IDs.';
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'array', 'required' => true, 'description' => 'Array of LINE user IDs.'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of LINE message objects.'],
            'notification_disabled' => ['type' => 'boolean', 'description' => 'Disable push notification when true.'],
        ];
    }

    /**
     * Send multicast messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->multicastMessage($args['to'] ?? [], $args['messages'] ?? [], (bool) ($args['notification_disabled'] ?? false)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
