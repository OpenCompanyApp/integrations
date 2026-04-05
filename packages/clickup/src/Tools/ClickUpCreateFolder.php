<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpCreateFolder implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_create_folder';
    }

    public function description(): string
    {
        return 'Create a new folder in a ClickUp space.';
    }

    public function parameters(): array
    {
        return [
            'space_id' => ['type' => 'string', 'required' => true, 'description' => 'Space ID to create the folder in.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Folder name.'],
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

            $result = $this->service->createFolder($spaceId, $data);

            return ToolResult::success(['id' => $result['id'] ?? '', 'name' => $result['name'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
