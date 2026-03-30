<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpCreateList implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_create_list';
    }

    public function description(): string
    {
        return 'Create a new list in a ClickUp space.';
    }

    public function parameters(): array
    {
        return [
            'space_id' => ['type' => 'string', 'required' => true, 'description' => 'Space ID to create the list in.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'List name.'],
            'content' => ['type' => 'string', 'description' => 'List description/content.'],
            'status' => ['type' => 'string', 'description' => 'List status.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $spaceId = $args['space_id'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($spaceId)) {
                return ToolResult::error('space_id is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];
            if (isset($args['content'])) {
                $data['content'] = $args['content'];
            }
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }

            $result = $this->service->createList($spaceId, $data);

            return ToolResult::success(['id' => $result['id'] ?? '', 'name' => $result['name'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
