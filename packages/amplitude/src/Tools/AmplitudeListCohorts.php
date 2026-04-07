<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeListCohorts — List behavioral cohorts from Amplitude.
 *
 * Calls GET /cohorts with optional project and limit filters.
 * Returns cohort definitions and membership counts.
 */
class AmplitudeListCohorts implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_list_cohorts';
    }

    public function description(): string
    {
        return 'List behavioral cohorts in Amplitude. Optionally filter by project ID. Returns cohort names, IDs, and membership counts.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'description' => 'Filter by Amplitude project ID.'],
            'limit'      => ['type' => 'integer', 'description' => 'Maximum number of cohorts to return (default: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $result = $this->service->listCohorts(
                projectId: isset($args['project_id']) ? (int) $args['project_id'] : null,
                limit: isset($args['limit']) ? (int) $args['limit'] : 100,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
