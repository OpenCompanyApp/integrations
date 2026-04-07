<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MixpanelGetFunnel — Retrieve funnel conversion data by ID.
 *
 * Calls GET /v1/funnels with funnel_id and returns detailed
 * conversion analytics for the specified funnel.
 */
class MixpanelGetFunnel implements Tool
{
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_get_funnel';
    }

    public function description(): string
    {
        return 'Retrieve detailed conversion data for a Mixpanel funnel by its ID. Returns step-by-step conversion rates and drop-off analytics.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Mixpanel funnel ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $result = $this->service->getFunnel($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
