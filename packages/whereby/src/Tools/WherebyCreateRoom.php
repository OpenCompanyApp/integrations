<?php

namespace OpenCompany\Integrations\Whereby\Tools;

use OpenCompany\Integrations\Whereby\WherebyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WherebyCreateRoom implements Tool
{
    public function __construct(
        private WherebyService $service,
    ) {}

    public function name(): string
    {
        return 'whereby_create_room';
    }

    public function description(): string
    {
        return 'Create a new Whereby video meeting room with optional configuration such as room mode, time limits, and participant settings.';
    }

    public function parameters(): array
    {
        return [
            'room_mode' => ['type' => 'string', 'required' => false, 'description' => 'Room mode, e.g. "normal" or "group".'],
            'room_name_prefix' => ['type' => 'string', 'required' => false, 'description' => 'Optional prefix for the generated room name.'],
            'start_date' => ['type' => 'string', 'required' => false, 'description' => 'ISO 8601 start date/time for the room.'],
            'end_date' => ['type' => 'string', 'required' => false, 'description' => 'ISO 8601 end date/time for the room.'],
            'fields' => ['type' => 'array', 'required' => false, 'description' => 'Additional room configuration fields such as lockRoomOnJoin, recording, etc.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Whereby integration is not configured.');
            }

            $params = [];

            if (!empty($args['room_mode'])) {
                $params['roomMode'] = $args['room_mode'];
            }
            if (!empty($args['room_name_prefix'])) {
                $params['roomNamePrefix'] = $args['room_name_prefix'];
            }
            if (!empty($args['start_date'])) {
                $params['startDate'] = $args['start_date'];
            }
            if (!empty($args['end_date'])) {
                $params['endDate'] = $args['end_date'];
            }
            if (!empty($args['fields']) && is_array($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->createRoom($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
