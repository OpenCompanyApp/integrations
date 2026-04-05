<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpGetFolder implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_get_folder';
    }

    public function description(): string
    {
        return 'Get details of a ClickUp folder by ID, including its lists.';
    }

    public function parameters(): array
    {
        return [
            'folder_id' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $folderId = $args['folder_id'] ?? '';
            if (empty($folderId)) {
                return ToolResult::error('folder_id is required.');
            }

            $result = $this->service->getFolder($folderId);

            $lists = array_map(fn (array $l) => [
                'id' => $l['id'] ?? '',
                'name' => $l['name'] ?? '',
            ], $result['lists'] ?? []);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'space' => [
                    'id' => $result['space']['id'] ?? '',
                    'name' => $result['space']['name'] ?? '',
                ],
                'lists' => $lists,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
