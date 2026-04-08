<?php

namespace OpenCompany\Integrations\Avalara\Tools;

use OpenCompany\Integrations\Avalara\AvalaraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AvalaraListCompanies implements Tool
{
    public function __construct(
        private AvalaraService $service,
    ) {}

    public function name(): string { return 'avalara_list_companies'; }

    public function description(): string
    {
        return 'List companies configured in your Avalara account. Supports filtering and pagination.';
    }

    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Number of companies to return per page (default 20).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of records to skip for pagination.'],
            'filter' => ['type' => 'string', 'description' => 'OData filter expression, e.g. "isDefault eq true".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Avalara integration is not configured.');
            }

            $result = $this->service->listCompanies(
                top: isset($args['top']) ? (int) $args['top'] : null,
                skip: isset($args['skip']) ? (int) $args['skip'] : null,
                filter: $args['filter'] ?? null,
            );

            $companies = $result['value'] ?? $result;

            $response = [
                'companies' => $companies,
                'count' => is_array($companies) ? count($companies) : 0,
            ];

            if (isset($result['@nextLink'])) {
                $response['next_page'] = $result['@nextLink'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
