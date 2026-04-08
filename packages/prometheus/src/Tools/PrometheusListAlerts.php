<?php

namespace OpenCompany\Integrations\Prometheus\Tools;

use OpenCompany\Integrations\Prometheus\PrometheusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Prometheus alerts with optional filtering.
 *
 * Returns alert names, states, labels, and annotations.
 */
class PrometheusListAlerts implements Tool
{
    /**
     * Create a new PrometheusListAlerts tool instance.
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
        return 'prometheus_list_alerts';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List Prometheus alerts. Optionally filter by alert state or label selectors. Returns alert names, states, labels, and annotations.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'filter' => ['type' => 'string', 'description' => 'Optional label selector filter (e.g., "severity=critical").'],
            'receiver' => ['type' => 'string', 'description' => 'Filter alerts by receiver name.'],
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

            $filters = [];
            if (isset($args['filter']) && !empty($args['filter'])) {
                $filters['filter'] = $args['filter'];
            }
            if (isset($args['receiver']) && !empty($args['receiver'])) {
                $filters['receiver'] = $args['receiver'];
            }

            $result = $this->service->listAlerts($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
