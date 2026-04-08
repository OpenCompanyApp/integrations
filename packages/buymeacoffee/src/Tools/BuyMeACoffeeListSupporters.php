<?php

namespace OpenCompany\Integrations\BuyMeACoffee\Tools;

use OpenCompany\Integrations\BuyMeACoffee\BuyMeACoffeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BuyMeACoffeeListSupporters implements Tool
{
    public function __construct(
        private BuyMeACoffeeService $service,
    ) {}

    public function name(): string
    {
        return 'buymeacoffee_list_supporters';
    }

    public function description(): string
    {
        return 'List all supporters in your Buy Me a Coffee account. Returns supporter names, emails, support amounts, and dates.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buy Me a Coffee integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listSupporters($params);

            $supporters = $result['data'] ?? $result['supporters'] ?? [];

            return ToolResult::success([
                'supporters' => $supporters,
                'totalCount' => count($supporters),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
