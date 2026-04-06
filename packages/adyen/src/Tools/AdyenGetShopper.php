<?php

namespace OpenCompany\Integrations\Adyen\Tools;

use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a specific shopper from Adyen by ID.
 *
 * Retrieves details of a single shopper, including their stored
 * payment methods and associated data.
 */
class AdyenGetShopper implements Tool
{
    /**
     * Create a new AdyenGetShopper tool instance.
     */
    public function __construct(
        private AdyenService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'adyen_get_shopper';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get details of a specific Adyen shopper by their ID. Returns shopper information including stored payment methods.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The shopper identifier (recurringDetailReference or shopperReference).'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Adyen integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getShopper($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
