<?php

namespace OpenCompany\Integrations\Mollie\Tools;

use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve enabled payment methods from Mollie.
 *
 * Maps to GET /methods which returns the list of payment methods
 * available for the authenticated account.
 */
class MollieGetCurrentUser implements Tool
{
    /**
     * Create a new MollieGetCurrentUser tool instance.
     */
    public function __construct(
        private MollieService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mollie_get_current_user';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Retrieve the enabled payment methods for the authenticated Mollie account. Returns a list of available payment methods (e.g., iDEAL, credit card, PayPal).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get payment methods tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mollie integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $methods = $result['_embedded']['methods'] ?? [];
            $count = count($methods);

            return ToolResult::success([
                'methods' => $methods,
                'count' => $count,
                '_links' => $result['_links'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
