<?php

namespace OpenCompany\Integrations\Flutterwave\Tools;

use OpenCompany\Integrations\Flutterwave\FlutterwaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Flutterwave transactions.
 *
 * Supports pagination, status, date range, customer, reference, and currency
 * filters from the Flutterwave transactions API.
 */
class FlutterwaveListTransactions implements Tool
{
    /**
     * Create a new FlutterwaveListTransactions tool instance.
     *
     * @param  FlutterwaveService  $service  The Flutterwave service used to make API calls.
     */
    public function __construct(
        private FlutterwaveService $service,
    ) {}

    /**
     * The unique tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'flutterwave_list_transactions';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List transactions from your Flutterwave account. Supports filtering by status and date range, with pagination.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string}>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by transaction status (e.g. "successful", "failed", "pending").'],
            'from' => ['type' => 'string', 'description' => 'Start date for filtering transactions (YYYY-MM-DD).'],
            'to' => ['type' => 'string', 'description' => 'End date for filtering transactions (YYYY-MM-DD).'],
            'customer_email' => ['type' => 'string', 'description' => 'Filter by the customer email address.'],
            'tx_ref' => ['type' => 'string', 'description' => 'Filter by merchant transaction reference.'],
            'customer_fullname' => ['type' => 'string', 'description' => 'Filter by the customer full name.'],
            'currency' => ['type' => 'string', 'description' => 'Filter by transaction currency.'],
        ];
    }

    /**
     * Execute the tool: list transactions from Flutterwave.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Flutterwave integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            if (isset($args['from'])) {
                $params['from'] = $args['from'];
            }

            if (isset($args['to'])) {
                $params['to'] = $args['to'];
            }

            if (isset($args['customer_email'])) {
                $params['customer_email'] = $args['customer_email'];
            }

            if (isset($args['tx_ref'])) {
                $params['tx_ref'] = $args['tx_ref'];
            }

            if (isset($args['customer_fullname'])) {
                $params['customer_fullname'] = $args['customer_fullname'];
            }

            if (isset($args['currency'])) {
                $params['currency'] = $args['currency'];
            }

            $result = $this->service->listTransactions($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
