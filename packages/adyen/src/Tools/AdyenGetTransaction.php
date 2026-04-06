<?php

namespace OpenCompany\Integrations\Adyen\Tools;

use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Adyen transaction.
 *
 * Retrieves full transaction details by its PSP (Payment Service Provider)
 * reference.
 */
class AdyenGetTransaction implements Tool
{
    /**
     * Create a new AdyenGetTransaction tool instance.
     *
     * @param  \OpenCompany\Integrations\Adyen\AdyenService  $service
     */
    public function __construct(
        private AdyenService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'adyen_get_transaction';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get details of a specific Adyen transaction by its PSP reference. Returns the full transaction object including amount, status, and payment details.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'psp_reference' => ['type' => 'string', 'required' => true, 'description' => 'The PSP reference of the transaction to retrieve (e.g., "8535296650153317").'],
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

            $pspReference = $args['psp_reference'] ?? '';

            if (empty($pspReference)) {
                return ToolResult::error('psp_reference is required.');
            }

            $result = $this->service->getTransaction($pspReference);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
