<?php

namespace OpenCompany\Integrations\Prometheus\Tools;

use OpenCompany\Integrations\Prometheus\PrometheusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the current authenticated Prometheus user info.
 *
 * Used primarily to verify authentication and retrieve user details.
 */
class PrometheusGetCurrentUser implements Tool
{
    /**
     * Create a new PrometheusGetCurrentUser tool instance.
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
        return 'prometheus_get_current_user';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get the current authenticated Prometheus user info. Useful for verifying authentication and retrieving user details.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [];
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

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
