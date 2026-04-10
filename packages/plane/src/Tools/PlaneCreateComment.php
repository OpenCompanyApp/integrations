<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a comment on a Plane.so issue.
 */
class PlaneCreateComment implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_create_comment';
    }

    public function description(): string
    {
        return <<<'DESC'
Add a comment to a Plane.so issue. The comment body should be provided in HTML format.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'The issue UUID.'],
            'comment_html' => ['type' => 'string', 'required' => true, 'description' => 'Comment content in HTML format.'],
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

            $comment = $this->service->createComment(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['issue_id'],
                ['comment_html' => $args['comment_html']],
            );

            return ToolResult::success([
                'id' => $comment['id'] ?? null,
                'issue' => $args['issue_id'],
                'created_at' => $comment['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
