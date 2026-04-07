<?php

namespace OpenCompany\Integrations\Avalara\Tools;

use OpenCompany\Integrations\Avalara\AvalaraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AvalaraListTaxCodes implements Tool
{
    public function __construct(
        private AvalaraService $service,
    ) {}

    public function name(): string { return 'avalara_list_tax_codes'; }

    public function description(): string
    {
        return 'List tax codes available in Avalara. Tax codes classify products and services for tax purposes. Supports filtering and pagination.';
    }

    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Number of tax codes to return per page (default 20).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of records to skip for pagination.'],
            'filter' => ['type' => 'string', 'description' => 'OData filter expression, e.g. "isActive eq true" or "taxCode eq \'P0000000\'".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Avalara integration is not configured.');
            }

            $result = $this->service->listTaxCodes(
                top: isset($args['top']) ? (int) $args['top'] : null,
                skip: isset($args['skip']) ? (int) $args['skip'] : null,
                filter: $args['filter'] ?? null,
            );

            $taxCodes = $result['value'] ?? $result;

            $response = [
                'tax_codes' => $taxCodes,
                'count' => is_array($taxCodes) ? count($taxCodes) : 0,
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
