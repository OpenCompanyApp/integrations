<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * List Fathom milestones for a site.
 */
class FathomListMilestones implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_list_milestones';
    }

    public function description(): string
    {
        return 'List milestones for a Fathom site with cursor pagination.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of milestones to return, 1-100.'],
            'starting_after' => ['type' => 'string', 'description' => 'Cursor; milestone ID to start after.'],
            'ending_before' => ['type' => 'string', 'description' => 'Cursor; milestone ID to end before.'],
        ];
    }

    /**
     * List milestones.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, limit, starting_after, ending_before).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            return ToolResult::success($this->service->listMilestones(
                (string) ($args['site_id'] ?? ''),
                isset($args['limit']) ? (int) $args['limit'] : 10,
                $args['starting_after'] ?? null,
                $args['ending_before'] ?? null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
