<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeListFunnels — List funnels from Amplitude.
 *
 * Calls GET /funnels with optional project and limit filters.
 * Returns funnel configurations and summary metrics.
 */
class AmplitudeListFunnels implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_list_funnels';
    }

    public function description(): string
    {
        return 'List funnels configured in Amplitude. Optionally filter by project ID. Returns funnel names, IDs, and summary conversion metrics.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'description' => 'Filter by Amplitude project ID.'],
            'limit'      => ['type' => 'integer', 'description' => 'Maximum number of funnels to return (default: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $result = $this->service->listFunnels(
                projectId: isset($args['project_id']) ? (int) $args['project_id'] : null,
                limit: isset($args['limit']) ? (int) $args['limit'] : 100,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
