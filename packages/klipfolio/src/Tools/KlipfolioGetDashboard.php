<?php

namespace OpenCompany\Integrations\Klipfolio\Tools;

use OpenCompany\Integrations\Klipfolio\KlipfolioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details for a specific Klipfolio dashboard by its ID.
 *
 * Returns the full dashboard object including layout, Klips (visualizations),
 * sharing settings, and other configuration.
 */
class KlipfolioGetDashboard implements Tool
{
    public function __construct(
        private KlipfolioService $service,
    ) {}

    public function name(): string
    {
        return 'klipfolio_get_dashboard';
    }

    public function description(): string
    {
        return 'Get details for a specific Klipfolio dashboard by ID, including its layout, Klips, and sharing settings.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique dashboard identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Klipfolio integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Dashboard ID is required.');
            }

            $result = $this->service->getDashboard($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
