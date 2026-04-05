<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all behavioural cohorts in Mixpanel.
 *
 * Returns a list of cohort definitions including IDs and names,
 * useful for discovering cohort IDs for further analysis.
 */
class MixpanelListCohorts implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_list_cohorts';
    }

    public function description(): string
    {
        return 'List all behavioural cohorts in the Mixpanel project.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'description' => 'Mixpanel project ID. Defaults to the configured project.'],
        ];
    }

    /**
     * List all cohorts in the project.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $projectId = $args['project_id'] ?? null;

            $result = $this->service->listCohorts($projectId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
