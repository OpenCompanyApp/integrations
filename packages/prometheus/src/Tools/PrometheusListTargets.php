<?php

namespace OpenCompany\Integrations\Prometheus\Tools;

use OpenCompany\Integrations\Prometheus\PrometheusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Prometheus scrape targets.
 *
 * Returns active and dropped targets with their health status and labels.
 */
class PrometheusListTargets implements Tool
{
    /**
     * Create a new PrometheusListTargets tool instance.
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
        return 'prometheus_list_targets';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List Prometheus scrape targets. Optionally filter by state (active or dropped). Returns target health status, labels, and scrape info.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'state' => ['type' => 'string', 'description' => 'Filter targets by state: "active" or "dropped".'],
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

            $state = $args['state'] ?? null;

            $result = $this->service->listTargets($state);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
