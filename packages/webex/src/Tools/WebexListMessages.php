<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\Integrations\Webex\WebexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebexListMessages implements Tool
{
    public function __construct(
        private WebexService $service,
    ) {}

    public function name(): string
    {
        return 'webex_list_messages';
    }

    public function description(): string
    {
        return 'List messages in a Webex room. Supports date-based filtering with before/after parameters and pagination. Returns message text, sender info, and timestamps.';
    }

    public function parameters(): array
    {
        return [
            'room_id' => ['type' => 'string', 'required' => true, 'description' => 'The room to list messages from.'],
            'max' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (1–1000, default: 50).'],
            'before' => ['type' => 'string', 'description' => 'List messages posted before this ISO 8601 timestamp.'],
            'after' => ['type' => 'string', 'description' => 'List messages posted after this ISO 8601 timestamp.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Webex integration is not configured.');
            }

            $roomId = $args['room_id'] ?? '';
            if (empty($roomId)) {
                return ToolResult::error('room_id is required.');
            }

            $max = isset($args['max']) ? (int) $args['max'] : 50;
            $result = $this->service->listMessages(
                $roomId,
                $max,
                $args['before'] ?? null,
                $args['after'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
