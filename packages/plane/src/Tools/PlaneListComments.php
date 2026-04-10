<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List comments on a Plane.so issue.
 */
class PlaneListComments implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_comments';
    }

    public function description(): string
    {
        return <<<'DESC'
List all comments on a Plane.so issue. Returns comment ID, content, author, and timestamps.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'The issue UUID.'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plane.so integration is not configured.');
            }

            $comments = $this->service->listComments(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['issue_id'],
            );

            $results = array_map(fn(array $comment) => [
                'id' => $comment['id'] ?? null,
                'comment_html' => $comment['comment_html'] ?? null,
                'created_by' => $comment['created_by'] ?? null,
                'created_at' => $comment['created_at'] ?? null,
                'updated_at' => $comment['updated_at'] ?? null,
            ], $comments);

            return ToolResult::success([
                'comments' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
