<?php

namespace OpenCompany\Integrations\PayPal\Tools;

use OpenCompany\Integrations\PayPal\PayPalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing PayPal invoices.
 *
 * Retrieves a list of invoices from the PayPal Invoicing API
 * with optional filtering by page, page size, and total required flag.
 */
class PayPalListInvoices implements Tool
{
    /**
     * Create a new PayPalListInvoices tool instance.
     *
     * @param  PayPalService  $service  The PayPal API service.
     */
    public function __construct(
        private PayPalService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'paypal_list_invoices';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'List PayPal invoices. Returns invoice IDs, numbers, statuses, amounts, and recipient details. Use pagination parameters to navigate through results.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of invoices per page (default: 20, max: 100).'],
            'total_required' => ['type' => 'boolean', 'description' => 'Whether to include the total count of invoices in the response (default: false).'],
            'fields' => ['type' => 'string', 'description' => 'Comma-separated list of fields to return (e.g., "items,payments").'],
        ];
    }

    /**
     * Execute the list invoices request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PayPal integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }
            if (isset($args['total_required'])) {
                $params['total_required'] = (bool) $args['total_required'];
            }
            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->listInvoices($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
