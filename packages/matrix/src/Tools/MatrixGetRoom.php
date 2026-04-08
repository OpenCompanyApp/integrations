<?php

namespace OpenCompany\Integrations\Matrix\Tools;

use OpenCompany\Integrations\Matrix\MatrixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MatrixGetRoom implements Tool
{
    public function __construct(
        private MatrixService $service,
    ) {}

    public function name(): string
    {
        return 'matrix_get_room';
    }

    public function description(): string
    {
        return 'Get details of a specific Matrix room, including name, topic, members, and aliases.';
    }

    public function parameters(): array
    {
        return [
            'room_id' => ['type' => 'string', 'required' => true, 'description' => 'The room ID (e.g., "!abc123:matrix.org").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Matrix integration is not configured.');
            }

            $result = $this->service->getRoom($args['room_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
