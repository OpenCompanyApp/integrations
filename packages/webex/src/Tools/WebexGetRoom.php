<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\Integrations\Webex\WebexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebexGetRoom implements Tool
{
    public function __construct(
        private WebexService $service,
    ) {}

    public function name(): string
    {
        return 'webex_get_room';
    }

    public function description(): string
    {
        return 'Get details for a specific Webex room by its ID. Returns room title, type (direct or group), creator, creation date, and last activity.';
    }

    public function parameters(): array
    {
        return [
            'room_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the Webex room.'],
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

            $result = $this->service->getRoom($roomId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
