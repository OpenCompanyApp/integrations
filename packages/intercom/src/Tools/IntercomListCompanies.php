<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Intercom companies with pagination.
 *
 * Returns a paginated list of companies with their IDs and names.
 */
class IntercomListCompanies implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_list_companies';
    }

    public function description(): string
    {
        return <<<'MD'
        List Intercom companies with pagination.
        Returns company IDs, names, and employee counts.
        Use limit and starting_after for pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of companies to return (default 20).'],
            'starting_after' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * List Intercom companies with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, starting_after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (! empty($args['starting_after'])) {
                $params['starting_after'] = $args['starting_after'];
            }

            $result = $this->service->listCompanies($params);

            $companies = array_map(function (array $company): array {
                return [
                    'id' => $company['id'] ?? '',
                    'name' => $company['name'] ?? '',
                    'employee_count' => $company['employee_count'] ?? null,
                    'industry' => $company['industry'] ?? '',
                ];
            }, $result['data'] ?? []);

            $output = ['results' => $companies];

            if (isset($result['pages']['next']['starting_after'])) {
                $output['starting_after'] = $result['pages']['next']['starting_after'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
