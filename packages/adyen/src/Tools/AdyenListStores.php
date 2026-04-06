<?php

namespace OpenCompany\Integrations\Adyen\Tools;

use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list stores for the Adyen merchant account.
 *
 * Retrieves a paginated list of stores associated with the
 * configured merchant account.
 */
class AdyenListStores implements Tool
{
    /**
     * Create a new AdyenListStores tool instance.
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
        return 'adyen_list_stores';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List stores for the configured Adyen merchant account. Returns store details including store codes, names, and addresses. The merchant account is automatically injected.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of stores to return per page.'],
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

            $result = $this->service->listStores($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
