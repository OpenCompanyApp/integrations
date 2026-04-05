<?php

namespace OpenCompany\Integrations\Razorpay\Tools;

use OpenCompany\Integrations\Razorpay\RazorpayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list refunds from Razorpay.
 *
 * Retrieves a paginated list of refunds with optional filters for
 * date range, count, and skip offset.
 */
class RazorpayListRefunds implements Tool
{
    /**
     * Create a new RazorpayListRefunds tool instance.
     */
    public function __construct(
        private RazorpayService $service,
    ) {}

    /**
     * The tool name identifier.
     */
    public function name(): string
    {
        return 'razorpay_list_refunds';
    }

    /**
     * A description of what this tool does, used by the AI agent.
     */
    public function description(): string
    {
        return 'List refunds from Razorpay. Supports pagination and date-range filters. Returns refund IDs, amounts, payment references, and statuses.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Number of refunds to return (default: 10, max: 100).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of refunds to skip for pagination.'],
            'from' => ['type' => 'integer', 'description' => 'Unix timestamp for the start of the date range.'],
            'to' => ['type' => 'integer', 'description' => 'Unix timestamp for the end of the date range.'],
        ];
    }

    /**
     * Execute the tool and return the list of refunds.
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
            if (isset($args['from'])) {
                $params['from'] = (int) $args['from'];
            }
            if (isset($args['to'])) {
                $params['to'] = (int) $args['to'];
            }

            $result = $this->service->listRefunds($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
