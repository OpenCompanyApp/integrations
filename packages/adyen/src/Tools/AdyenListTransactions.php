<?php

namespace OpenCompany\Integrations\Adyen\Tools;

use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list transactions from the Adyen transaction feed.
 *
 * Retrieves a paginated list of transactions for the configured
 * merchant account.
 */
class AdyenListTransactions implements Tool
{
    /**
     * Create a new AdyenListTransactions tool instance.
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
        return 'adyen_list_transactions';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List transactions from the Adyen transaction feed. Returns a paginated list of transactions for the merchant account. Use page and size parameters to control pagination.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
            'size' => ['type' => 'integer', 'description' => 'Number of transactions per page (default: 20).'],
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

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['size'])) {
                $params['size'] = (int) $args['size'];
            }

            $result = $this->service->listTransactions($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
