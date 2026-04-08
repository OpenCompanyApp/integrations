<?php

namespace OpenCompany\Integrations\BuyMeACoffee\Tools;

use OpenCompany\Integrations\BuyMeACoffee\BuyMeACoffeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BuyMeACoffeeGetExtra implements Tool
{
    public function __construct(
        private BuyMeACoffeeService $service,
    ) {}

    public function name(): string
    {
        return 'buymeacoffee_get_extra';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Buy Me a Coffee extra by its ID. Returns full extra data including description, pricing, and purchase count.';
    }

    public function parameters(): array
    {
        return [
            'extra_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the extra to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buy Me a Coffee integration is not configured.');
            }

            if (empty($args['extra_id'])) {
                return ToolResult::error('extra_id is required.');
            }

            $result = $this->service->getExtra($args['extra_id']);

            $extra = $result['data'] ?? $result['extra'] ?? $result;

            return ToolResult::success($extra);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
