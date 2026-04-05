<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpGetList implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_get_list';
    }

    public function description(): string
    {
        return 'Get details of a ClickUp list by ID.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $listId = $args['list_id'] ?? '';
            if (empty($listId)) {
                return ToolResult::error('list_id is required.');
            }

            $result = $this->service->getList($listId);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'content' => $result['content'] ?? '',
                'status' => $result['status'] ?? null,
                'task_count' => $result['task_count'] ?? 0,
                'space' => [
                    'id' => $result['space']['id'] ?? '',
                    'name' => $result['space']['name'] ?? '',
                ],
                'folder' => [
                    'id' => $result['folder']['id'] ?? '',
                    'name' => $result['folder']['name'] ?? '',
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
