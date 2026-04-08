<?php

namespace OpenCompany\Integrations\Whereby\Tools;

use OpenCompany\Integrations\Whereby\WherebyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WherebyDeleteRoom implements Tool
{
    public function __construct(
        private WherebyService $service,
    ) {}

    public function name(): string
    {
        return 'whereby_delete_room';
    }

    public function description(): string
    {
        return 'Delete a Whereby room by its name. This action is permanent and cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'room_name' => ['type' => 'string', 'required' => true, 'description' => 'The unique name or identifier of the Whereby room to delete.'],
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

            $result = $this->service->deleteRoom($args['room_name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
