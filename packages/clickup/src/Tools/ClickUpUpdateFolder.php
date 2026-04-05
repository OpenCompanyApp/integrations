<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpUpdateFolder implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_update_folder';
    }

    public function description(): string
    {
        return "Update a ClickUp folder's name.";
    }

    public function parameters(): array
    {
        return [
            'folder_id' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'New folder name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $folderId = $args['folder_id'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($folderId)) {
                return ToolResult::error('folder_id is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $result = $this->service->updateFolder($folderId, ['name' => $name]);

            return ToolResult::success(['id' => $result['id'] ?? '', 'name' => $result['name'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
