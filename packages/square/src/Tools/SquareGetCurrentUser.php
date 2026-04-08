<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current authenticated Square merchant.
 *
 * Returns merchant details including business name, country, currency, and status.
 */
class SquareGetCurrentUser implements Tool
{
    /**
     * @param  SquareService  $service  The Square API client
     */
    public function __construct(
        private SquareService $service,
    ) {}

    public function name(): string
    {
        return 'square_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the current authenticated Square merchant account.
        Returns merchant details including business name, country, currency, and status.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the current authenticated Square merchant.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $result = $this->service->getCurrentUser();
            $merchant = $result['merchant'] ?? [];

            return ToolResult::success([
                'id' => $merchant['id'] ?? '',
                'business_name' => $merchant['business_name'] ?? '',
                'country' => $merchant['country'] ?? '',
                'currency' => $merchant['currency'] ?? '',
                'status' => $merchant['status'] ?? '',
                'main_location_id' => $merchant['main_location_id'] ?? null,
                'created_at' => $merchant['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
