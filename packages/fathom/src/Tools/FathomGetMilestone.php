<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Get a Fathom milestone.
 */
class FathomGetMilestone implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_get_milestone';
    }

    public function description(): string
    {
        return 'Get one milestone by site ID and milestone ID.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'milestone_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom milestone ID.'],
        ];
    }

    /**
     * Get a milestone.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, milestone_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            return ToolResult::success($this->service->getMilestone((string) ($args['site_id'] ?? ''), (string) ($args['milestone_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
