<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for one Webex room.
 */
class WebexGetRoom extends AbstractWebexTool implements Tool
{
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

    /**
     * Fetch a room by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
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
