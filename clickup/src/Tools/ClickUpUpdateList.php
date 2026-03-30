<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpUpdateList implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_update_list';
    }

    public function description(): string
    {
        return "Update a ClickUp list's name, content, or status.";
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List ID.'],
            'name' => ['type' => 'string', 'description' => 'New list name.'],
            'content' => ['type' => 'string', 'description' => 'New list description/content.'],
            'status' => ['type' => 'string', 'description' => 'New list status.'],
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

            $data = [];
            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (isset($args['content'])) {
                $data['content'] = $args['content'];
            }
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update (name, content, status) is required.');
            }

            $result = $this->service->updateList($listId, $data);

            return ToolResult::success(['id' => $result['id'] ?? '', 'name' => $result['name'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
