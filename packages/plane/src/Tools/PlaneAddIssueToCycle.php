<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add an issue to a Plane.so cycle.
 */
class PlaneAddIssueToCycle implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_add_issue_to_cycle';
    }

    public function description(): string
    {
        return <<<'DESC'
Add an existing issue to a Plane.so cycle. The issue will be tracked within the cycle's sprint/iteration.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'cycle_id' => ['type' => 'string', 'required' => true, 'description' => 'The cycle UUID.'],
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'The issue UUID to add to the cycle.'],
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

            $result = $this->service->addIssueToCycle(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['cycle_id'],
                $args['issue_id'],
            );

            return ToolResult::success([
                'added' => true,
                'issue_id' => $args['issue_id'],
                'cycle_id' => $args['cycle_id'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
