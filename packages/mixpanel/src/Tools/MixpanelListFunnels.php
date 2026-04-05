<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all funnels in the Mixpanel project.
 *
 * Returns a list of funnel definitions including IDs and names,
 * useful for discovering funnel IDs before querying specific funnels.
 */
class MixpanelListFunnels implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_list_funnels';
    }

    public function description(): string
    {
        return 'List all funnels in the Mixpanel project.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'description' => 'Mixpanel project ID. Defaults to the configured project.'],
        ];
    }

    /**
     * List all funnels in the project.
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

            $result = $this->service->listFunnels($projectId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
