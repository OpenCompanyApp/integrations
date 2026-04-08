<?php

namespace OpenCompany\Integrations\Prometheus\Tools;

use OpenCompany\Integrations\Prometheus\PrometheusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single Prometheus rule group by its name.
 *
 * Returns the rule group definition including all rules within the group.
 */
class PrometheusGetRule implements Tool
{
    /**
     * Create a new PrometheusGetRule tool instance.
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
        return 'prometheus_get_rule';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get a Prometheus rule group by name. Returns the full rule group definition including all rules within the group.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the rule group to retrieve.'],
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
                return ToolResult::error('Rule group name is required.');
            }

            $result = $this->service->getRule($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
