<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a comment on a Notion page or reply to an existing discussion.
 */
class NotionCreateComment implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_create_comment';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a comment on a Notion page. You can either start a new discussion
        (provide parent_id) or reply to an existing discussion (provide discussion_id).
        Provide body_text for simple text, or body_children for rich content blocks.
        MD;
    }

    public function parameters(): array
    {
        return [
            'parent_id' => ['type' => 'string', 'description' => 'Page ID to create a comment on. Required if discussion_id is not provided.'],
            'discussion_id' => ['type' => 'string', 'description' => 'Discussion ID to reply to. Required if parent_id is not provided.'],
            'body_text' => ['type' => 'string', 'description' => 'Simple text content for the comment.'],
            'body_children' => ['type' => 'string', 'description' => 'Rich text block content as a JSON array of block objects.'],
        ];
    }

    /**
     * Create a comment on a page or reply to a discussion.
     *
     * @param  array<string, mixed>  $args  Tool arguments (parent_id, discussion_id, body_text, body_children)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $parentId = $args['parent_id'] ?? '';
            $discussionId = $args['discussion_id'] ?? '';

            if (empty($parentId) && empty($discussionId)) {
                return ToolResult::error('Either parent_id or discussion_id is required.');
            }

            $body = [];

            if (! empty($parentId)) {
                $body['parent'] = ['page_id' => $parentId];
            }

            if (! empty($discussionId)) {
                $body['discussion_id'] = $discussionId;
            }

            // Build the rich text body
            $richText = [];

            if (isset($args['body_text'])) {
                $richText[] = ['text' => ['content' => $args['body_text']]];
            } elseif (isset($args['body_children'])) {
                $children = $args['body_children'];
                if (is_string($children)) {
                    $decoded = json_decode($children, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ToolResult::error('Invalid JSON in body_children: ' . json_last_error_msg());
                    }
                    $children = $decoded;
                }
                $richText = $children;
            } else {
                return ToolResult::error('Either body_text or body_children is required.');
            }

            $body['rich_text'] = $richText;

            $result = $this->service->createComment($body);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'created_time' => $result['created_time'] ?? null,
                'created_by' => $result['created_by'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
