<?php

namespace OpenCompany\Integrations\Razorpay\Tools;

use OpenCompany\Integrations\Razorpay\RazorpayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list customers from Razorpay.
 *
 * Retrieves a paginated list of customers with optional filters for
 * count and skip offset.
 */
class RazorpayListCustomers implements Tool
{
    /**
     * Create a new RazorpayListCustomers tool instance.
     */
    public function __construct(
        private RazorpayService $service,
    ) {}

    /**
     * The tool name identifier.
     */
    public function name(): string
    {
        return 'razorpay_list_customers';
    }

    /**
     * A description of what this tool does, used by the AI agent.
     */
    public function description(): string
    {
        return 'List customers from Razorpay. Supports pagination. Returns customer IDs, names, emails, and contact numbers.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Number of customers to return (default: 10, max: 100).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of customers to skip for pagination.'],
        ];
    }

    /**
     * Execute the tool and return the list of customers.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Razorpay integration is not configured.');
            }

            $params = [];
            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['skip'])) {
                $params['skip'] = (int) $args['skip'];
            }

            $result = $this->service->listCustomers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
