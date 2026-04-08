<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Append child blocks to a Notion page or block.
 */
class NotionAppendBlockChildren implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_append_block_children';
    }

    public function description(): string
    {
        return <<<'MD'
        Append blocks to a Notion page or block. Provide children as a JSON array of block objects.
        Example: [{"object":"block","type":"paragraph","paragraph":{"rich_text":[{"type":"text","text":{"content":"Hello world"}}]}}]
        MD;
    }

    public function parameters(): array
    {
        return [
            'block_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the parent block or page to append children to.'],
            'children' => ['type' => 'string', 'required' => true, 'description' => 'Array of block objects to append, as a JSON string or array.'],
        ];
    }

    /**
     * Append block children to a parent block or page.
     *
     * @param  array<string, mixed>  $args  Tool arguments (block_id, children)
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

            $children = $args['children'] ?? '';
            if (is_string($children)) {
                $decoded = json_decode($children, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return ToolResult::error('Invalid JSON in children: ' . json_last_error_msg());
                }
                $children = $decoded;
            }

            if (empty($children)) {
                return ToolResult::error('children array is required and must not be empty.');
            }

            $result = $this->service->appendBlockChildren($blockId, ['children' => $children]);
            $results = $result['results'] ?? [];

            $output = [];
            foreach ($results as $block) {
                $output[] = [
                    'id' => $block['id'] ?? '',
                    'type' => $block['type'] ?? '',
                ];
            }

            return ToolResult::success([
                'count' => count($output),
                'appended' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
