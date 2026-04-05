<?php

namespace OpenCompany\Integrations\Zuora\Tools;

use OpenCompany\Integrations\Zuora\ZuoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Zuora account by ID.
 *
 * Retrieves detailed information about a specific customer account including
 * contact info, billing settings, and account metrics.
 */
class ZuoraGetAccount implements Tool
{
    /**
     * Create a new ZuoraGetAccount tool instance.
     */
    public function __construct(
        private ZuoraService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'zuora_get_account';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get details of a specific Zuora account by its ID. Returns account name, number, status, balance, and billing information.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'account_id' => ['type' => 'string', 'required' => true, 'description' => 'The Zuora account ID (e.g., "8a90b89a8a...").'],
        ];
    }

    /**
     * Execute the tool — get a Zuora account.
     *
     * @param  array<string, mixed> $args Tool arguments
     * @return ToolResult The result containing account details or an error message
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zuora integration is not configured.');
            }

            $accountId = $args['account_id'] ?? '';

            if (empty($accountId)) {
                return ToolResult::error('Account ID is required.');
            }

            $result = $this->service->getAccount($accountId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
