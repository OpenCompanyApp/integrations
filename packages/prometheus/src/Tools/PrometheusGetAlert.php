<?php

namespace OpenCompany\Integrations\Prometheus\Tools;

use OpenCompany\Integrations\Prometheus\PrometheusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single Prometheus alert by its name.
 *
 * Returns the alert definition including labels, annotations, state, and expression.
 */
class PrometheusGetAlert implements Tool
{
    /**
     * Create a new PrometheusGetAlert tool instance.
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
        return 'prometheus_get_alert';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get a Prometheus alert by name. Returns the full alert definition including labels, annotations, and state.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the alert to retrieve.'],
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

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('Alert name is required.');
            }

            $result = $this->service->getAlert($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
