<?php

namespace OpenCompany\Integrations\TrustMrr\Tools;

use OpenCompany\Integrations\TrustMrr\TrustMrrService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TrustMrrListStartups implements Tool
{
    public function __construct(
        private TrustMrrService $service,
    ) {}

    public function name(): string
    {
        return 'trustmrr_list_startups';
    }

    public function description(): string
    {
        return 'Browse and filter startups with verified revenue on TrustMRR. Filter by sale status, category, revenue range, MRR, growth, or asking price. All monetary values are in USD cents (e.g. 100000 = $1,000).';
    }

    public function parameters(): array
    {
        return [
            'sort' => ['type' => 'string', 'description' => 'Sort order. Options: revenue-desc (default), revenue-asc, price-desc, price-asc, multiple-asc, multiple-desc, growth-desc, growth-asc, listed-desc, listed-asc, best-deal.'],
            'on_sale' => ['type' => 'boolean', 'description' => 'Filter by sale status. true = only for sale, false = only not for sale. Omit for all.'],
            'category' => ['type' => 'string', 'description' => 'Filter by category: ai, saas, developer-tools, fintech, marketing, ecommerce, productivity, design-tools, no-code, analytics, crypto-web3, education, health-fitness, social-media, content-creation, sales, customer-support, recruiting, real-estate, travel, legal, security, iot-hardware, green-tech, entertainment, games, community, news-magazines, utilities, marketplace, mobile-apps.'],
            'x_handle' => ['type' => 'string', 'description' => 'Filter by founder\'s X (Twitter) handle. Omit the @ symbol.'],
            'min_revenue' => ['type' => 'number', 'description' => 'Minimum last-30-days revenue in USD cents (e.g. 100000 = $1,000).'],
            'max_revenue' => ['type' => 'number', 'description' => 'Maximum last-30-days revenue in USD cents.'],
            'min_mrr' => ['type' => 'number', 'description' => 'Minimum monthly recurring revenue in USD cents.'],
            'max_mrr' => ['type' => 'number', 'description' => 'Maximum monthly recurring revenue in USD cents.'],
            'min_growth' => ['type' => 'number', 'description' => 'Minimum 30-day revenue growth as decimal (e.g. 0.1 = 10%).'],
            'max_growth' => ['type' => 'number', 'description' => 'Maximum 30-day revenue growth as decimal.'],
            'min_price' => ['type' => 'number', 'description' => 'Minimum asking price in USD cents (e.g. 1000000 = $10,000).'],
            'max_price' => ['type' => 'number', 'description' => 'Maximum asking price in USD cents.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Results per page, 1-50 (default: 10).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $params = [];

            // Map snake_case args to camelCase API params
            $mapping = [
                'sort' => 'sort',
                'on_sale' => 'onSale',
                'category' => 'category',
                'x_handle' => 'xHandle',
                'min_revenue' => 'minRevenue',
                'max_revenue' => 'maxRevenue',
                'min_mrr' => 'minMrr',
                'max_mrr' => 'maxMrr',
                'min_growth' => 'minGrowth',
                'max_growth' => 'maxGrowth',
                'min_price' => 'minPrice',
                'max_price' => 'maxPrice',
                'page' => 'page',
                'limit' => 'limit',
            ];

            foreach ($mapping as $schemaKey => $apiKey) {
                if (isset($args[$schemaKey])) {
                    $params[$apiKey] = $args[$schemaKey];
                }
            }

            // Cap limit at API maximum
            if (isset($params['limit'])) {
                $params['limit'] = min((int) $params['limit'], 50);
            }

            // Convert boolean on_sale to string
            if (isset($params['onSale'])) {
                $params['onSale'] = $params['onSale'] ? 'true' : 'false';
            }

            $result = $this->service->listStartups($params);

            $startups = $result['data'] ?? [];
            $meta = $result['meta'] ?? [];

            return ToolResult::success([
                'startups' => $startups,
                'total' => $meta['total'] ?? 0,
                'page' => $meta['page'] ?? 1,
                'has_more' => $meta['hasMore'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
