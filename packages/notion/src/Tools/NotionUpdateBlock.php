<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update the content or archived state of a Notion block.
 */
class NotionUpdateBlock implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_update_block';
    }

    public function description(): string
    {
        return <<<'MD'
        Update the content of a Notion block. Provide the block ID and the type-specific
        content to update. For example, to update a paragraph block, provide:
        {"type": "paragraph", "paragraph": {"rich_text": [{"text": {"content": "New text"}}]}}
        Only the fields you include will be updated.
        MD;
    }

    public function parameters(): array
    {
        return [
            'block_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the block to update.'],
            'type' => ['type' => 'string', 'description' => 'Block type to update (e.g., "paragraph", "heading_1", "to_do").'],
            'content' => ['type' => 'string', 'description' => 'Type-specific block content as a JSON object. For example: {"rich_text": [{"text": {"content": "Updated text"}}]}'],
            'archived' => ['type' => 'boolean', 'description' => 'Whether to archive the block.'],
        ];
    }

    /**
     * Update a block's type-specific content or archived state.
     *
     * @param  array<string, mixed>  $args  Tool arguments (block_id, type, content, archived)
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

            $body = [];

            if (isset($args['archived'])) {
                $body['archived'] = (bool) $args['archived'];
            }

            if (isset($args['type']) && isset($args['content'])) {
                $type = $args['type'];
                $content = $args['content'];
                if (is_string($content)) {
                    $decoded = json_decode($content, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ToolResult::error('Invalid JSON in content: ' . json_last_error_msg());
                    }
                    $content = $decoded;
                }
                $body[$type] = $content;
            }

            $result = $this->service->updateBlock($blockId, $body);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'type' => $result['type'] ?? '',
                'updated' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
