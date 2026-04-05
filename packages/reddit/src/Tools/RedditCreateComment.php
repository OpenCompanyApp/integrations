<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for posting a comment on a Reddit post or replying to another comment.
 *
 * Uses Reddit's `/api/comment` endpoint. The parent must be specified as a
 * fullname (e.g., "t3_abc123" for a post, "t1_def456" for a comment).
 * Supports Markdown formatting in the comment body.
 */
class RedditCreateComment implements Tool
{
    /**
     * Create a new RedditCreateComment tool instance.
     *
     * @param  RedditService  $service  The Reddit API service for making authenticated requests.
     */
    public function __construct(
        private RedditService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'reddit_create_comment';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Post a comment on a Reddit post or reply to an existing comment. The comment body supports Markdown formatting. Use "t3_" prefix for post IDs or "t1_" prefix for comment IDs as the parent.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'The fullname of the thing to comment on. Use "t3_{post_id}" to comment on a post, or "t1_{comment_id}" to reply to a comment.'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The comment body. Supports Markdown formatting.'],
        ];
    }

    /**
     * Execute the tool: post a comment.
     *
     * @param  array<string, mixed>  $args  Tool arguments including 'parent' and 'text'.
     * @return ToolResult The result confirming comment creation or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $parent = $args['parent'];
            $text = $args['text'];

            if (empty($text)) {
                return ToolResult::error('Comment text cannot be empty.');
            }

            $result = $this->service->createComment($parent, $text);

            return ToolResult::success($this->formatResponse($result, $text));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Reddit comment API response into a structured result.
     *
     * @param  array<string, mixed>  $result  Raw Reddit API response.
     * @return array<string, mixed> Formatted response with comment creation details.
     */
    private function formatResponse(array $result, string $text): array
    {
        $json = $result['json'] ?? [];
        $data = $json['data'] ?? [];

        if (($json['errors'] ?? []) !== []) {
            $errors = array_map(fn ($e) => implode(': ', $e), $json['errors']);
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        $things = $data['things'] ?? [];
        $comment = $things[0]['data'] ?? [];

        return [
            'success' => true,
            'id' => $comment['id'] ?? null,
            'name' => $comment['name'] ?? null,
            'body' => $comment['body'] ?? $text,
            'permalink' => isset($comment['permalink']) ? 'https://www.reddit.com' . $comment['permalink'] : null,
        ];
    }
}
