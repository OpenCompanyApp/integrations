<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing hot posts from a subreddit.
 *
 * Retrieves the hottest (currently trending) posts from a specified subreddit
 * using Reddit's `/r/{subreddit}/hot` endpoint. Supports pagination via
 * cursor-based `after` and `before` parameters.
 */
class RedditListPosts implements Tool
{
    /**
     * Create a new RedditListPosts tool instance.
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
        return 'reddit_list_posts';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List hot posts from a subreddit on Reddit. Returns post titles, scores, authors, and permalinks. Use for browsing trending content in any public subreddit.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'subreddit' => ['type' => 'string', 'required' => true, 'description' => 'The subreddit name without the r/ prefix (e.g., "laravel", "php").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of posts to return (default: 25, max: 100).'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor — fullname of the last post seen (from previous response).'],
            'before' => ['type' => 'string', 'description' => 'Pagination cursor — fullname of a post to list posts before it.'],
        ];
    }

    /**
     * Execute the tool: fetch hot posts from the specified subreddit.
     *
     * @param  array<string, mixed>  $args  Tool arguments including 'subreddit', and optional 'limit', 'after', 'before'.
     * @return ToolResult The result containing formatted post data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $subreddit = $args['subreddit'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $after = $args['after'] ?? null;
            $before = $args['before'] ?? null;

            $result = $this->service->listPosts($subreddit, $limit, $after, $before);

            return ToolResult::success($this->formatResponse($result, $subreddit));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Reddit API listing response into a structured result.
     *
     * @param  array<string, mixed>  $result  Raw Reddit API response.
     * @return array<string, mixed> Formatted response with posts and pagination info.
     */
    private function formatResponse(array $result, string $subreddit): array
    {
        $data = $result['data'] ?? [];
        $children = $data['children'] ?? [];

        $posts = array_map(function (array $child): array {
            $post = $child['data'] ?? [];
            return [
                'id' => $post['id'] ?? null,
                'name' => $post['name'] ?? null,
                'title' => $post['title'] ?? null,
                'author' => $post['author'] ?? null,
                'subreddit' => $post['subreddit'] ?? null,
                'score' => $post['score'] ?? 0,
                'numComments' => $post['num_comments'] ?? 0,
                'url' => $post['url'] ?? null,
                'permalink' => isset($post['permalink']) ? 'https://www.reddit.com' . $post['permalink'] : null,
                'selftext' => isset($post['selftext']) && $post['selftext'] !== '' ? mb_substr($post['selftext'], 0, 300) : null,
                'createdUtc' => $post['created_utc'] ?? null,
                'isSelf' => $post['is_self'] ?? false,
                'linkFlairText' => $post['link_flair_text'] ?? null,
            ];
        }, $children);

        return [
            'subreddit' => $subreddit,
            'posts' => $posts,
            'count' => count($posts),
            'after' => $data['after'] ?? null,
            'before' => $data['before'] ?? null,
        ];
    }
}
