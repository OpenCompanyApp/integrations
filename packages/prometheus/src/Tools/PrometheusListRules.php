<?php

namespace OpenCompany\Integrations\Prometheus\Tools;

use OpenCompany\Integrations\Prometheus\PrometheusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Prometheus alerting and recording rules.
 *
 * Returns rule groups with their associated rules, expressions, and states.
 */
class PrometheusListRules implements Tool
{
    /**
     * Create a new PrometheusListRules tool instance.
     *
     * @param PrometheusService $service The Prometheus API service.
     */
    public function __construct(
        private PrometheusService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'prometheus_list_rules';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List Prometheus alerting and recording rules. Optionally filter by type. Returns rule groups with their rules and states.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Filter rules by type: "alert" for alerting rules or "recording" for recording rules.'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Prometheus integration is not configured.');
            }

            $type = $args['type'] ?? null;

            $result = $this->service->listRules($type);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
