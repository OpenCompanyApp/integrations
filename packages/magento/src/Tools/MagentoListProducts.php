<?php

namespace OpenCompany\Integrations\Magento\Tools;

use OpenCompany\Integrations\Magento\MagentoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list products from the Magento catalog.
 *
 * Retrieves a list of products with support for search criteria
 * filtering and pagination.
 */
class MagentoListProducts implements Tool
{
    /**
     * Create a new MagentoListProducts tool instance.
     *
     * @param  \OpenCompany\Integrations\Magento\MagentoService  $service
     */
    public function __construct(
        private MagentoService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'magento_list_products';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List products from the Magento catalog. Returns a list of products with support for search criteria filtering and pagination.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'search_criteria' => ['type' => 'string', 'description' => 'Search criteria filter expression (e.g., "name:like:%shirt%").'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of products per page (default: 20).'],
            'current_page' => ['type' => 'integer', 'description' => 'Current page number for pagination (starts at 1).'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Magento integration is not configured.');
            }

            $params = [];

            if (isset($args['search_criteria'])) {
                $params['searchCriteria'] = $args['search_criteria'];
            }

            if (isset($args['page_size'])) {
                $params['searchCriteria']['pageSize'] = (int) $args['page_size'];
            }

            if (isset($args['current_page'])) {
                $params['searchCriteria']['currentPage'] = (int) $args['current_page'];
            }

            $result = $this->service->listProducts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
