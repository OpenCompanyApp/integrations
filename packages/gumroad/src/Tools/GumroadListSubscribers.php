<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

use OpenCompany\Integrations\Gumroad\GumroadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GumroadListSubscribers implements Tool
{
    public function __construct(
        private GumroadService $service,
    ) {}

    public function name(): string
    {
        return 'gumroad_list_subscribers';
    }

    public function description(): string
    {
        return 'List all subscribers in your Gumroad account. Optionally filter by product ID to get subscribers for a specific membership or product.';
    }

    public function parameters(): array
    {
        return [
            'product_id' => ['type' => 'string', 'description' => 'Filter subscribers by a specific product ID (e.g., a membership product).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gumroad integration is not configured.');
            }

            $params = [];
            if (!empty($args['product_id'])) {
                $params['product_id'] = $args['product_id'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listSubscribers($params);

            $subscribers = $result['subscribers'] ?? [];

            return ToolResult::success([
                'subscribers' => $subscribers,
                'totalCount' => count($subscribers),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
