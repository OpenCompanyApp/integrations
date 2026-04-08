<?php

namespace OpenCompany\Integrations\Whereby\Tools;

use OpenCompany\Integrations\Whereby\WherebyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WherebyGetRoom implements Tool
{
    public function __construct(
        private WherebyService $service,
    ) {}

    public function name(): string
    {
        return 'whereby_get_room';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Whereby room, including meeting URL, configuration, and host details.';
    }

    public function parameters(): array
    {
        return [
            'room_name' => ['type' => 'string', 'required' => true, 'description' => 'The unique name or identifier of the Whereby room.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Whereby integration is not configured.');
            }

            if (empty($args['room_name'])) {
                return ToolResult::error('room_name is required.');
            }

            $result = $this->service->getRoom($args['room_name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
