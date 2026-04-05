<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxGetFolder implements Tool
{
    /**
     * Create a new BoxGetFolder tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_get_folder';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get metadata for a Box folder by ID. Returns the folder name, size, created/modified dates, parent folder, and item counts. Use "0" for root.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'folder_id' => ['type' => 'string', 'required' => true, 'description' => 'The Box folder ID. Use "0" for the root folder.'],
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

            $result = $this->service->getFolder($args['folder_id']);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'type' => $result['type'] ?? 'folder',
                'name' => $result['name'] ?? null,
                'size' => $result['size'] ?? null,
                'created_at' => $result['created_at'] ?? null,
                'modified_at' => $result['modified_at'] ?? null,
                'description' => $result['description'] ?? null,
                'parent' => $result['parent'] ?? null,
                'item_collection' => $result['item_collection'] ?? null,
                'shared_link' => $result['shared_link'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
