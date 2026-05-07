<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ChargeOver\ChargeOverService;

/**
 * Fetch a single ChargeOver transaction record.
 */
class ChargeOverGetTransaction implements Tool
{
    /**
     * @param  ChargeOverService  $service  The ChargeOver API client.
     */
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_get_transaction';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific ChargeOver transaction by transaction_id.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The ChargeOver transaction_id.'],
        ];
    }

    /**
     * Get a transaction by ID through the ChargeOver API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Transaction ID is required.');
            }

            $result = $this->service->getTransaction((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
