<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

use OpenCompany\Integrations\Pagerduty\PagerdutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Team.
 *
 * Retrieves a single PagerDuty team by its ID, including description,
 * parent team, and default role information.
 *
 * @see https://developer.pagerduty.com/api-reference/get-a-team
 */
class PagerdutyGetTeam implements Tool
{
    /**
     * @param  PagerdutyService  $service  The PagerDuty API service instance.
     */
    public function __construct(
        private PagerdutyService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'pagerduty_get_team';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get full details for a single PagerDuty team, including name, description, parent team, and default role.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The team ID (e.g., "PIMJOGV").'],
        ];
    }

    /**
     * Execute the get team tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the team ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Team ID is required.');
            }

            $result = $this->service->getTeam($id);

            return ToolResult::success($result['team'] ?? $result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
