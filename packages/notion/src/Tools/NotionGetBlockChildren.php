<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the child blocks of a Notion block or page.
 */
class NotionGetBlockChildren implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_get_block_children';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the child blocks of a Notion block or page. Returns a list of block objects.
        Use this to read the content of a page or to navigate nested block structures.
        Supports pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'block_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the block or page to get children for.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (max 100, default 100).'],
            'start_cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * Retrieve child blocks of a page or block with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (block_id, page_size, start_cursor)
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

            $params = [];

            if (isset($args['page_size'])) {
                $params['page_size'] = min((int) $args['page_size'], 100);
            }

            if (isset($args['start_cursor'])) {
                $params['start_cursor'] = $args['start_cursor'];
            }

            $result = $this->service->getBlockChildren($blockId, $params);
            $results = $result['results'] ?? [];

            $output = [];
            foreach ($results as $block) {
                $output[] = [
                    'id' => $block['id'] ?? '',
                    'type' => $block['type'] ?? '',
                    'has_children' => $block['has_children'] ?? false,
                    'archived' => $block['archived'] ?? false,
                ];
            }

            $response = ['count' => count($output), 'results' => $output, 'raw' => $results];

            if (isset($result['has_more']) && $result['has_more']) {
                $response['has_more'] = true;
                $response['next_cursor'] = $result['next_cursor'] ?? null;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
