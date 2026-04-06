<?php

namespace OpenCompany\Integrations\Matrix\Tools;

use OpenCompany\Integrations\Matrix\MatrixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MatrixCreateRoom implements Tool
{
    public function __construct(
        private MatrixService $service,
    ) {}

    public function name(): string
    {
        return 'matrix_create_room';
    }

    public function description(): string
    {
        return 'Create a new room on the Matrix homeserver. Returns the newly created room ID.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The room name (displayed to users).'],
            'topic' => ['type' => 'string', 'description' => 'The room topic / description.'],
            'visibility' => ['type' => 'string', 'description' => 'Room visibility: "public" or "private" (default: "private").'],
            'preset' => ['type' => 'string', 'description' => 'Room preset: "private_chat", "public_chat", or "trusted_private_chat" (default: "private_chat").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Matrix integration is not configured.');
            }

            $params = [
                'name' => $args['name'],
            ];

            if (isset($args['topic'])) {
                $params['topic'] = $args['topic'];
            }
            if (isset($args['visibility'])) {
                $params['visibility'] = $args['visibility'];
            }
            if (isset($args['preset'])) {
                $params['preset'] = $args['preset'];
            }

            $result = $this->service->createRoom($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
