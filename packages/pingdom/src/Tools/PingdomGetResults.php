<?php

namespace OpenCompany\Integrations\Pingdom\Tools;

use OpenCompany\Integrations\Pingdom\PingdomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PingdomGetResults implements Tool
{
    public function __construct(
        private PingdomService $service,
    ) {}

    public function name(): string
    {
        return 'pingdom_get_results';
    }

    public function description(): string
    {
        return 'Get detailed test results for a Pingdom uptime check, including individual probe responses and response times.';
    }

    public function parameters(): array
    {
        return [
            'check_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the check.'],
            'from' => ['type' => 'integer', 'description' => 'Start timestamp (Unix epoch) for the results window.'],
            'to' => ['type' => 'integer', 'description' => 'End timestamp (Unix epoch) for the results window.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
            'probes' => ['type' => 'string', 'description' => 'Comma-separated probe IDs to filter by.'],
            'status' => ['type' => 'string', 'description' => 'Filter by result status: "up", "down", "unconfirmed_down".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pingdom integration is not configured.');
            }

            $checkId = (int) $args['check_id'];

            $params = [];
            if (isset($args['from'])) {
                $params['from'] = (int) $args['from'];
            }
            if (isset($args['to'])) {
                $params['to'] = (int) $args['to'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['probes'])) {
                $params['probes'] = $args['probes'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->getResults($checkId, $params);

            $results = $result['results'] ?? $result;

            return ToolResult::success([
                'check_id' => $checkId,
                'results' => $results,
                'count' => is_array($results) ? count($results) : 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
