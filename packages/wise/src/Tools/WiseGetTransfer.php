<?php

namespace OpenCompany\Integrations\Wise\Tools;

use OpenCompany\Integrations\Wise\WiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Wise transfer.
 *
 * Retrieves full transfer details including amounts, exchange rate,
 * recipient, and current status.
 */
class WiseGetTransfer implements Tool
{
    /**
     * Create a new WiseGetTransfer instance.
     *
     * @param WiseService $service The Wise API service client.
     */
    public function __construct(
        private WiseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'wise_get_transfer';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Get details of a specific Wise transfer by ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'transfer_id' => ['type' => 'integer', 'description' => 'The Wise transfer ID.', 'required' => true],
        ];
    }

    /**
     * Execute the tool — get a transfer by ID.
     *
     * @param array $args Tool arguments containing transfer_id.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wise integration is not configured.');
            }

            $transferId = $args['transfer_id'] ?? null;

            if (empty($transferId)) {
                return ToolResult::error('Parameter "transfer_id" is required.');
            }

            $transfer = $this->service->getTransfer($transferId);

            return ToolResult::success($transfer);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
