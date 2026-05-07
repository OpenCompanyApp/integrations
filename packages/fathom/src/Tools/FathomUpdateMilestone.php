<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Update a Fathom milestone.
 */
class FathomUpdateMilestone implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_update_milestone';
    }

    public function description(): string
    {
        return 'Update a Fathom milestone name or date.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'milestone_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom milestone ID.'],
            'name' => ['type' => 'string', 'description' => 'Updated milestone name.'],
            'milestone_date' => ['type' => 'string', 'description' => 'Updated milestone date in YYYY-MM-DD format.'],
        ];
    }

    /**
     * Update a milestone.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, milestone_id, name, milestone_date).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            return ToolResult::success($this->service->updateMilestone((string) ($args['site_id'] ?? ''), (string) ($args['milestone_id'] ?? ''), array_intersect_key($args, ['name' => true, 'milestone_date' => true])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
