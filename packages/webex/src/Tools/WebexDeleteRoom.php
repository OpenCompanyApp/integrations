<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Webex room.
 */
class WebexDeleteRoom extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_delete_room';
    }

    public function description(): string
    {
        return 'Delete a Webex room by room ID.';
    }

    public function parameters(): array
    {
        return [
            'room_id' => ['type' => 'string', 'required' => true, 'description' => 'Room ID.'],
        ];
    }

    /**
     * Delete a room.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['room_id'])) {
                return ToolResult::error('room_id is required.');
            }

            return ToolResult::success($this->service->deleteRoom((string) $args['room_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
