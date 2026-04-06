<?php

namespace OpenCompany\Integrations\Klipfolio\Tools;

use OpenCompany\Integrations\Klipfolio\KlipfolioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details for a specific Klipfolio metric by its ID.
 *
 * Returns the full metric object including its formula, data bindings,
 * formatting options, and other configuration.
 */
class KlipfolioGetMetric implements Tool
{
    public function __construct(
        private KlipfolioService $service,
    ) {}

    public function name(): string
    {
        return 'klipfolio_get_metric';
    }

    public function description(): string
    {
        return 'Get details for a specific Klipfolio metric by ID, including its formula, data bindings, and formatting.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique metric identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Klipfolio integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Metric ID is required.');
            }

            $result = $this->service->getMetric($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
