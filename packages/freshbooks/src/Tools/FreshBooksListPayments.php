<?php

namespace OpenCompany\Integrations\FreshBooks\Tools;

use OpenCompany\Integrations\FreshBooks\FreshBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshBooksListPayments implements Tool
{
    public function __construct(
        private FreshBooksService $service,
    ) {}

    public function name(): string
    {
        return 'freshbooks_list_payments';
    }

    public function description(): string
    {
        return 'List payments from FreshBooks. Returns payment details including amount, date, client, invoice, and payment method. Supports filtering and pagination.';
    }

    public function parameters(): array
    {
        return [
            'search' => ['type' => 'object', 'description' => 'Search filters. Keys: clientid, invoiceid, date_from, date_to, type (check/credit/card/bank). Pass as an object.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (default: 15, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('FreshBooks integration is not configured. Please provide an access token and account ID.');
            }

            $params = [];

            if (isset($args['search'])) {
                $search = $args['search'];
                if (is_string($search)) {
                    $search = json_decode($search, true) ?? [];
                }
                foreach ($search as $key => $value) {
                    $params["search[{$key}]"] = $value;
                }
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['per_page'])) {
                $params['per_page'] = min((int) $args['per_page'], 100);
            }

            $result = $this->service->listPayments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
