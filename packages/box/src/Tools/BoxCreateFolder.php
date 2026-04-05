<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxCreateFolder implements Tool
{
    /**
     * Create a new BoxCreateFolder tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_create_folder';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new folder in Box. Provide a folder name and optionally a parent folder ID (defaults to root). Returns the new folder metadata.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new folder.'],
            'parent_folder_id' => ['type' => 'string', 'description' => 'The parent folder ID. Use "0" for the root folder.', 'default' => '0'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Box integration is not configured.');
            }

            $name = $args['name'];
            $parentId = $args['parent_folder_id'] ?? '0';

            if (empty($name)) {
                return ToolResult::error('Folder name is required.');
            }

            $result = $this->service->createFolder($name, $parentId);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'type' => $result['type'] ?? 'folder',
                'name' => $result['name'] ?? $name,
                'parent' => $result['parent'] ?? ['id' => $parentId],
                'message' => "Folder '{$name}' created successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
