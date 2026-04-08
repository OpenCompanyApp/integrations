<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Notion block by its ID.
 */
class NotionDeleteBlock implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_delete_block';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete a Notion block by its ID. This permanently removes the block
        (moves it to trash if it is a top-level page block).
        MD;
    }

    public function parameters(): array
    {
        return [
            'block_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the block to delete.'],
        ];
    }

    /**
     * Permanently delete a block by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (block_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $blockId = $args['block_id'] ?? '';

            if (empty($blockId)) {
                return ToolResult::error('block_id is required.');
            }

            $result = $this->service->deleteBlock($blockId);

            return ToolResult::success([
                'id' => $result['id'] ?? $blockId,
                'deleted' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
