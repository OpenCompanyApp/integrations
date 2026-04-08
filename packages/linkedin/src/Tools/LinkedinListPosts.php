<?php

namespace OpenCompany\Integrations\Linkedin\Tools;

use OpenCompany\Integrations\Linkedin\LinkedinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List LinkedIn UGC posts for an author.
 *
 * Returns a paginated list of posts with their IDs and metadata.
 */
class LinkedinListPosts implements Tool
{
    /**
     * @param  LinkedinService  $service  The LinkedIn API client
     */
    public function __construct(
        private LinkedinService $service,
    ) {}

    public function name(): string
    {
        return 'linkedin_list_posts';
    }

    public function description(): string
    {
        return <<<'MD'
        List LinkedIn UGC posts for an author.
        Returns post IDs, lifecycle state, and creation timestamps.
        Use author, count, and start for filtering and pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'author' => ['type' => 'string', 'required' => true, 'description' => 'Author URN (e.g. "urn:li:person:ABC123" or "urn:li:organization:12345").'],
            'count' => ['type' => 'integer', 'description' => 'Maximum number of posts to return (default 10, max 100).'],
            'start' => ['type' => 'integer', 'description' => 'Pagination offset (0-based).'],
        ];
    }

    /**
     * List LinkedIn UGC posts.
     *
     * @param  array<string, mixed>  $args  Tool arguments (author, count, start)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $author = $args['author'] ?? '';
            if (empty($author)) {
                return ToolResult::error('author is required. Provide a LinkedIn URN (e.g. "urn:li:person:ABC123").');
            }

            $params = ['q' => 'authors', 'authors' => 'List(' . $author . ')'];

            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['start'])) {
                $params['start'] = (int) $args['start'];
            }

            $result = $this->service->listPosts($params);

            $posts = array_map(function (array $post): array {
                return [
                    'id' => $post['id'] ?? '',
                    'lifecycle_state' => $post['lifecycleState'] ?? '',
                    'created' => $post['created'] ?? [],
                    'last_modified' => $post['lastModified'] ?? [],
                    'visibility' => $post['visibility'] ?? [],
                ];
            }, $result['elements'] ?? []);

            $output = ['results' => $posts];

            if (isset($result['paging'])) {
                $output['paging'] = $result['paging'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
