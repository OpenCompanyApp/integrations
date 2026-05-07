<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Webex room.
 */
class WebexUpdateRoom extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_update_room';
    }

    public function description(): string
    {
        return 'Update Webex room metadata, such as title.';
    }

    public function parameters(): array
    {
        return [
            'room_id' => ['type' => 'string', 'required' => true, 'description' => 'Room ID.'],
            'title' => ['type' => 'string', 'description' => 'New room title.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official room update fields.'],
        ];
    }

    /**
     * Update a room.
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

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['title']));
            if ($payload === []) {
                return ToolResult::error('At least one update field is required.');
            }

            return ToolResult::success($this->service->updateRoom((string) $args['room_id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
