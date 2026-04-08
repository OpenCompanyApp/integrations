<?php

namespace OpenCompany\Integrations\Wealthbox\Tools;

use OpenCompany\Integrations\Wealthbox\WealthboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WealthboxListEvents implements Tool
{
    /**
     * Create a new WealthboxListEvents tool instance.
     */
    public function __construct(
        private WealthboxService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wealthbox_list_events';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List calendar events from Wealthbox CRM. Returns a paginated list of events with their title, date, time, and associated contacts.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of events per page (default: 25, max: 200).'],
            'start_date' => ['type' => 'string', 'description' => 'Filter events starting from this date (ISO 8601, e.g., "2026-04-01").'],
            'end_date' => ['type' => 'string', 'description' => 'Filter events up to this date (ISO 8601, e.g., "2026-04-30").'],
        ];
    }

    /**
     * Execute the list events tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wealthbox integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['start_date'])) {
                $params['start_date'] = $args['start_date'];
            }
            if (isset($args['end_date'])) {
                $params['end_date'] = $args['end_date'];
            }

            $result = $this->service->listEvents($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
