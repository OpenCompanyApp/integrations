<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a link on a Plane.so issue.
 */
class PlaneCreateIssueLink implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_create_issue_link';
    }

    public function description(): string
    {
        return <<<'DESC'
Attach an external link to a Plane.so issue. Provide a title and a valid URL.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'The issue UUID.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Display title for the link.'],
            'url' => ['type' => 'string', 'required' => true, 'description' => 'The URL to link to.'],
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

            $link = $this->service->createIssueLink(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['issue_id'],
                [
                    'title' => $args['title'],
                    'url' => $args['url'],
                ],
            );

            return ToolResult::success([
                'id' => $link['id'] ?? null,
                'title' => $link['title'] ?? $args['title'],
                'url' => $link['url'] ?? $args['url'],
                'created_at' => $link['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
