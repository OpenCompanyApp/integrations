<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Square customers with optional filtering.
 *
 * Supports pagination with cursor.
 */
class SquareListCustomers implements Tool
{
    /**
     * @param  SquareService  $service  The Square API client
     */
    public function __construct(
        private SquareService $service,
    ) {}

    public function name(): string
    {
        return 'square_list_customers';
    }

    public function description(): string
    {
        return <<<'MD'
        List Square customers with optional filtering.
        Supports pagination with cursor.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of customers to return (1–100, default 20).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — returned from a previous request.'],
            'sort_field' => ['type' => 'string', 'description' => 'Sort field (DEFAULT, CREATED_AT, FAMILY_NAME, GIVEN_NAME).'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort order (ASC, DESC).'],
        ];
    }

    /**
     * List Square customers with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }
            if (isset($args['sort_field'])) {
                $params['sort_field'] = $args['sort_field'];
            }
            if (isset($args['sort_order'])) {
                $params['sort_order'] = $args['sort_order'];
            }

            $result = $this->service->listCustomers($params);

            $customers = array_map(function (array $c) {
                return [
                    'id' => $c['id'] ?? '',
                    'given_name' => $c['given_name'] ?? '',
                    'family_name' => $c['family_name'] ?? '',
                    'email_address' => $c['email_address'] ?? '',
                    'phone_number' => $c['phone_number'] ?? null,
                    'created_at' => $c['created_at'] ?? null,
                ];
            }, $result['customers'] ?? []);

            return ToolResult::success([
                'customers' => $customers,
                'cursor' => $result['cursor'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
