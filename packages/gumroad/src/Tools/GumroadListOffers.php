<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

use OpenCompany\Integrations\Gumroad\GumroadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GumroadListOffers implements Tool
{
    public function __construct(
        private GumroadService $service,
    ) {}

    public function name(): string
    {
        return 'gumroad_list_offers';
    }

    public function description(): string
    {
        return 'List all offers (discount codes) in your Gumroad account. Returns offer codes, discount amounts, and associated products.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gumroad integration is not configured.');
            }

            $result = $this->service->listOffers();

            $offers = $result['offers'] ?? [];

            return ToolResult::success([
                'offers' => $offers,
                'totalCount' => count($offers),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
