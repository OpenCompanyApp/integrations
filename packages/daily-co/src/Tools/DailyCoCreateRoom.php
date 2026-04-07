<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

use OpenCompany\Integrations\DailyCo\DailyCoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DailyCoCreateRoom implements Tool
{
    public function __construct(
        private DailyCoService $service,
    ) {}

    public function name(): string
    {
        return 'daily_co_create_room';
    }

    public function description(): string
    {
        return 'Create a new Daily.co video room. Specify a room name and optional properties like privacy mode, max participants, and recording settings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'A unique name for the room. If omitted, Daily.co generates a random name.'],
            'privacy' => ['type' => 'string', 'description' => 'Room privacy: "private" (default) or "public".'],
            'properties' => ['type' => 'object', 'description' => 'Room configuration as a JSON object (e.g., {"max_participants": 10, "enable_recording": "cloud", "exp": 1700000000}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Daily.co integration is not configured.');
            }

            $properties = [];

            if (!empty($args['name'])) {
                $properties['name'] = $args['name'];
            }

            if (!empty($args['privacy'])) {
                $properties['privacy'] = $args['privacy'];
            }

            if (isset($args['properties'])) {
                $extra = is_string($args['properties'])
                    ? json_decode($args['properties'], true) ?? []
                    : $args['properties'];
                $properties = array_merge($properties, $extra);
            }

            $result = $this->service->createRoom($properties);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
