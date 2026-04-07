<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MixpanelListCohorts — List all behavioral cohorts in Mixpanel.
 *
 * Calls GET /v1/cohorts/list and returns all configured cohorts.
 */
class MixpanelListCohorts implements Tool
{
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_list_cohorts';
    }

    public function description(): string
    {
        return 'List all behavioral cohorts in the Mixpanel project. Returns cohort names, IDs, and sizes.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $result = $this->service->listCohorts();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
