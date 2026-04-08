<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeGetFunnel — Retrieve a single funnel by ID.
 *
 * Calls GET /funnels/{id} and returns the full funnel configuration
 * including steps, conversion rates, and time breakdowns.
 */
class AmplitudeGetFunnel implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_get_funnel';
    }

    public function description(): string
    {
        return 'Retrieve a single Amplitude funnel by its ID. Returns the full funnel definition including steps, conversion rates, and drop-off metrics.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Amplitude funnel ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $result = $this->service->getFunnel($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
