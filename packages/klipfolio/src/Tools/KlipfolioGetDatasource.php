<?php

namespace OpenCompany\Integrations\Klipfolio\Tools;

use OpenCompany\Integrations\Klipfolio\KlipfolioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details for a specific Klipfolio data source by its ID.
 *
 * Returns the full data source object including its connector type,
 * refresh settings, query parameters, and other configuration.
 */
class KlipfolioGetDatasource implements Tool
{
    public function __construct(
        private KlipfolioService $service,
    ) {}

    public function name(): string
    {
        return 'klipfolio_get_datasource';
    }

    public function description(): string
    {
        return 'Get details for a specific Klipfolio data source by ID, including its connector type, refresh settings, and configuration.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique data source identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Klipfolio integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Data source ID is required.');
            }

            $result = $this->service->getDatasource($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
