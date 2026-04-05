<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a specific Reddit post with its comments.
 *
 * Fetches a post and its comment tree using Reddit's `/comments/{id}` endpoint.
 * The response contains two listings: the post data and the comment tree.
 */
class RedditGetPost implements Tool
{
    /**
     * Create a new RedditGetPost tool instance.
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
        return 'reddit_get_post';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a specific Reddit post with its top comments. Returns the post content, score, author, and a threaded comment preview.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The base36 post ID (e.g., "abc123"). Can be found in Reddit URLs: reddit.com/r/subreddit/comments/{id}/...'],
            'comment_limit' => ['type' => 'integer', 'description' => 'Maximum number of comments to return (default: 25, max: 100).'],
            'deep' => ['type' => 'boolean', 'description' => 'Whether to deeply expand comment replies (default: false). Warning: can return large responses.'],
        ];
    }

    /**
     * Execute the tool: fetch a post and its comments.
     *
     * @param  array<string, mixed>  $args  Tool arguments including 'id', and optional 'comment_limit', 'deep'.
     * @return ToolResult The result containing the post and formatted comments, or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $id = $args['id'];
            $commentLimit = isset($args['comment_limit']) ? (int) $args['comment_limit'] : 25;
            $deep = ($args['deep'] ?? false) === true;

            $result = $this->service->getPost($id, $commentLimit, $deep);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Reddit comments API response into a structured result.
     *
     * The Reddit /comments/{id} endpoint returns a two-element array:
     * - [0]: the post listing
     * - [1]: the comments listing
     *
     * @param  array<int, array<string, mixed>>  $result  Raw Reddit API response (two listings).
     * @return array<string, mixed> Formatted response with post data and comments.
     */
    private function formatResponse(array $result): array
    {
        // First element is the post listing
        $postListing = $result[0]['data']['children'][0]['data'] ?? [];
        // Second element is the comments listing
        $commentsListing = $result[1]['data']['children'] ?? [];

        $post = [
            'id' => $postListing['id'] ?? null,
            'title' => $postListing['title'] ?? null,
            'author' => $postListing['author'] ?? null,
            'subreddit' => $postListing['subreddit'] ?? null,
            'score' => $postListing['score'] ?? 0,
            'upvoteRatio' => $postListing['upvote_ratio'] ?? null,
            'numComments' => $postListing['num_comments'] ?? 0,
            'url' => $postListing['url'] ?? null,
            'permalink' => isset($postListing['permalink']) ? 'https://www.reddit.com' . $postListing['permalink'] : null,
            'selftext' => $postListing['selftext'] ?? null,
            'createdUtc' => $postListing['created_utc'] ?? null,
            'isSelf' => $postListing['is_self'] ?? false,
            'linkFlairText' => $postListing['link_flair_text'] ?? null,
        ];

        $comments = array_map(function (array $child): array {
            if (($child['kind'] ?? null) !== 't1') {
                return ['type' => 'more'];
            }
            return $this->formatComment($child['data'] ?? []);
        }, array_filter($commentsListing, fn ($child) => ($child['kind'] ?? null) === 't1'));

        return [
            'post' => $post,
            'comments' => array_values($comments),
            'commentCount' => count($comments),
        ];
    }

    /**
     * Format a single comment, optionally including first-level replies.
     *
     * @param  array<string, mixed>  $data  Raw comment data from Reddit API.
     * @return array<string, mixed> Formatted comment with nested replies.
     */
    private function formatComment(array $data): array
    {
        $comment = [
            'id' => $data['id'] ?? null,
            'name' => $data['name'] ?? null,
            'author' => $data['author'] ?? null,
            'body' => $data['body'] ?? null,
            'score' => $data['score'] ?? 0,
            'createdUtc' => $data['created_utc'] ?? null,
            'permalink' => isset($data['permalink']) ? 'https://www.reddit.com' . $data['permalink'] : null,
        ];

        $replies = $data['replies'] ?? null;
        if (is_array($replies) && isset($replies['data']['children'])) {
            $comment['replies'] = array_values(array_map(function (array $child): array {
                return $this->formatComment($child['data'] ?? []);
            }, array_filter($replies['data']['children'], fn ($c) => ($c['kind'] ?? null) === 't1')));
        }

        return $comment;
    }
}
