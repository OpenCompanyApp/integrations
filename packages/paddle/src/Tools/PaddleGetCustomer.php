<?php

namespace OpenCompany\Integrations\Paddle\Tools;

use OpenCompany\Integrations\Paddle\PaddleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Paddle customer by ID.
 *
 * Returns the decoded Paddle customer response including status,
 * contact fields, locale, custom data, and timestamps.
 */
class PaddleGetCustomer implements Tool
{
    /**
     * Create a new PaddleGetCustomer tool instance.
     *
     * @param  PaddleService  $service  The Paddle API service.
     */
    public function __construct(
        private PaddleService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'paddle_get_customer';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Paddle customer by their ID.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Paddle customer ID (e.g., "ctm_01abc123").'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paddle integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Customer ID is required.');
            }

            $result = $this->service->getCustomer($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
