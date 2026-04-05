<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single Grafana team by its ID.
 *
 * Returns team details including name, email, and member count.
 */
class GrafanaGetTeam implements Tool
{
    /**
     * Create a new GrafanaGetTeam tool instance.
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
        return 'grafana_get_team';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get a Grafana team by its ID. Returns team name, email, and member count.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The team ID.'],
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
                return ToolResult::error('Team ID is required.');
            }

            $result = $this->service->getTeam((int) $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
