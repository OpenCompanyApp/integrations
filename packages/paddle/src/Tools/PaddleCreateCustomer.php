<?php

namespace OpenCompany\Integrations\Paddle\Tools;

use OpenCompany\Integrations\Paddle\PaddleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a customer record in Paddle.
 *
 * Accepts the required email address and optional display name used for
 * invoicing and customer management workflows.
 */
class PaddleCreateCustomer implements Tool
{
    /**
     * Create a new PaddleCreateCustomer tool instance.
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
        return 'paddle_create_customer';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new customer in Paddle. An email address is required.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Customer email address.'],
            'name' => ['type' => 'string', 'description' => 'Customer display name.'],
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

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('Email is required to create a customer.');
            }

            $result = $this->service->createCustomer(
                email: $email,
                name: $args['name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
