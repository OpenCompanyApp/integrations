<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated Grafana user.
 *
 * Useful for verifying credentials and identifying the connected account.
 */
class GrafanaGetCurrentUser implements Tool
{
    /**
     * Create a new GrafanaGetCurrentUser tool instance.
     *
     * @param GrafanaService $service The Grafana API service.
     */
    public function __construct(
        private GrafanaService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'grafana_get_current_user';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get the currently authenticated Grafana user. Useful for verifying credentials and identifying the connected account.';
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
                return ToolResult::error('Grafana integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
