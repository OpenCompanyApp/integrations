<?php

namespace OpenCompany\Integrations\Flutterwave\Tools;

use OpenCompany\Integrations\Flutterwave\FlutterwaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List customers registered on the Flutterwave account.
 *
 * Supports Flutterwave pagination with a page parameter.
 */
class FlutterwaveListCustomers implements Tool
{
    /**
     * Create a new FlutterwaveListCustomers tool instance.
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
        return 'flutterwave_list_customers';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List customers registered on your Flutterwave account, with pagination support.';
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
        ];
    }

    /**
     * Execute the tool: list customers from Flutterwave.
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

            $result = $this->service->listCustomers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
