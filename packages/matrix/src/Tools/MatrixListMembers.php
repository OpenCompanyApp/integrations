<?php

namespace OpenCompany\Integrations\Matrix\Tools;

use OpenCompany\Integrations\Matrix\MatrixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MatrixListMembers implements Tool
{
    public function __construct(
        private MatrixService $service,
    ) {}

    public function name(): string
    {
        return 'matrix_list_members';
    }

    public function description(): string
    {
        return 'List members of a Matrix room. Returns user IDs, display names, and avatar URLs.';
    }

    public function parameters(): array
    {
        return [
            'room_id' => ['type' => 'string', 'required' => true, 'description' => 'The room ID (e.g., "!abc123:matrix.org").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of members to return (default: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Matrix integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $result = $this->service->listMembers($args['room_id'], $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
