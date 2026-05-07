<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Create a Fathom milestone.
 */
class FathomCreateMilestone implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_create_milestone';
    }

    public function description(): string
    {
        return 'Create a milestone for a Fathom site.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Milestone name.'],
            'milestone_date' => ['type' => 'string', 'required' => true, 'description' => 'Milestone date in YYYY-MM-DD format.'],
        ];
    }

    /**
     * Create a milestone.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, name, milestone_date).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            return ToolResult::success($this->service->createMilestone((string) ($args['site_id'] ?? ''), array_intersect_key($args, ['name' => true, 'milestone_date' => true])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
