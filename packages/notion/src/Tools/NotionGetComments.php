<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve comments on a Notion page or block.
 */
class NotionGetComments implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_get_comments';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve comments on a Notion page or block. Returns all comment objects
        with their content, authors, and timestamps. Supports pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'block_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the block or page to get comments for.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (max 100, default 100).'],
            'start_cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * Retrieve comments for a block or page with optional pagination.
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

            $result = $this->service->getComments($blockId, $params);
            $results = $result['results'] ?? [];

            if (empty($results)) {
                return ToolResult::success('No comments found.');
            }

            $output = [];
            foreach ($results as $comment) {
                $text = '';
                $richText = $comment['rich_text'] ?? [];
                foreach ($richText as $rt) {
                    $text .= $rt['plain_text'] ?? '';
                }

                $output[] = [
                    'id' => $comment['id'] ?? '',
                    'text' => $text,
                    'created_time' => $comment['created_time'] ?? null,
                    'created_by' => $comment['created_by'] ?? [],
                    'discussion_id' => $comment['discussion_id'] ?? null,
                ];
            }

            $response = ['count' => count($output), 'comments' => $output];

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
