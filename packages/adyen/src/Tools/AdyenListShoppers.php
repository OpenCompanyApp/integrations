<?php

namespace OpenCompany\Integrations\Adyen\Tools;

use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List shoppers with stored payment methods from Adyen.
 *
 * Retrieves a paginated list of shoppers who have stored payment methods
 * for the configured merchant account.
 */
class AdyenListShoppers implements Tool
{
    /**
     * Create a new AdyenListShoppers tool instance.
     */
    public function __construct(
        private AdyenService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'adyen_list_shoppers';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List shoppers with stored payment methods in Adyen. Returns shopper details for the configured merchant account.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of shoppers to return (default: 20).'],
            'page' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
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

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['page'])) {
                $params['page'] = $args['page'];
            }

            $result = $this->service->listShoppers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
