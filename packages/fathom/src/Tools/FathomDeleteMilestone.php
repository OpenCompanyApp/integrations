<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Delete a Fathom milestone.
 */
class FathomDeleteMilestone implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_delete_milestone';
    }

    public function description(): string
    {
        return 'Delete a Fathom milestone. This is destructive and cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'milestone_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom milestone ID.'],
        ];
    }

    /**
     * Delete a milestone.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, milestone_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            return ToolResult::success($this->service->deleteMilestone((string) ($args['site_id'] ?? ''), (string) ($args['milestone_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
