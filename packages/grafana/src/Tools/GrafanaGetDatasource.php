<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single Grafana datasource by its ID.
 *
 * Returns the full datasource configuration including connection details.
 */
class GrafanaGetDatasource implements Tool
{
    /**
     * Create a new GrafanaGetDatasource tool instance.
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
        return 'grafana_get_datasource';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get a Grafana datasource by its ID. Returns full datasource configuration.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The datasource ID.'],
        ];
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

            $id = $args['id'] ?? null;
            if ($id === null) {
                return ToolResult::error('Datasource ID is required.');
            }

            $result = $this->service->getDatasource((int) $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
