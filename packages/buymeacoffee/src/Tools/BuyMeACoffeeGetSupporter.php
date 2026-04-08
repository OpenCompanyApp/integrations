<?php

namespace OpenCompany\Integrations\BuyMeACoffee\Tools;

use OpenCompany\Integrations\BuyMeACoffee\BuyMeACoffeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BuyMeACoffeeGetSupporter implements Tool
{
    public function __construct(
        private BuyMeACoffeeService $service,
    ) {}

    public function name(): string
    {
        return 'buymeacoffee_get_supporter';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Buy Me a Coffee supporter by their ID. Returns full supporter data including support history and notes.';
    }

    public function parameters(): array
    {
        return [
            'supporter_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the supporter to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buy Me a Coffee integration is not configured.');
            }

            if (empty($args['supporter_id'])) {
                return ToolResult::error('supporter_id is required.');
            }

            $result = $this->service->getSupporter($args['supporter_id']);

            $supporter = $result['data'] ?? $result['supporter'] ?? $result;

            return ToolResult::success($supporter);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
