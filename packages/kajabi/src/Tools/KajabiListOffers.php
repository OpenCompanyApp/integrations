<?php

namespace OpenCompany\Integrations\Kajabi\Tools;

use OpenCompany\Integrations\Kajabi\KajabiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KajabiListOffers implements Tool
{
    public function __construct(
        private KajabiService $service,
    ) {}

    public function name(): string
    {
        return 'kajabi_list_offers';
    }

    public function description(): string
    {
        return 'List all offers in your Kajabi account. Returns offer names, IDs, prices, and associated products.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kajabi integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listOffers($params);

            $offers = $result['offers'] ?? $result['data'] ?? [];

            return ToolResult::success([
                'offers' => $offers,
                'totalCount' => count($offers),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
