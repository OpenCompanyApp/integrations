<?php

namespace OpenCompany\Integrations\Prometheus\Tools;

use OpenCompany\Integrations\Prometheus\PrometheusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single Prometheus target by its instance address.
 *
 * Returns target health, last scrape time, scrape duration, and error info.
 */
class PrometheusGetTarget implements Tool
{
    /**
     * Create a new PrometheusGetTarget tool instance.
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
        return 'prometheus_get_target';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get a Prometheus target by its instance address. Returns target health, last scrape info, and discovery labels.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'instance' => ['type' => 'string', 'required' => true, 'description' => 'The target instance address (e.g., "localhost:9090").'],
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

            $instance = $args['instance'] ?? '';
            if (empty($instance)) {
                return ToolResult::error('Target instance is required.');
            }

            $result = $this->service->getTarget($instance);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
