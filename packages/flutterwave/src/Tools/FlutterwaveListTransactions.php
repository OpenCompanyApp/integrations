<?php

namespace OpenCompany\Integrations\Flutterwave\Tools;

use OpenCompany\Integrations\Flutterwave\FlutterwaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

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
        ];
    }

    /**
     * Execute the tool: list transactions from Flutterwave.
     *
     * @param  array  $args  The tool arguments (page, status, from, to).
     * @return ToolResult The result containing the list of transactions or an error message.
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

            $result = $this->service->listTransactions($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
