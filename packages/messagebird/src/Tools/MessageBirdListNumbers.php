<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\Integrations\MessageBird\MessageBirdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MessageBirdListNumbers implements Tool
{
    public function __construct(
        private MessageBirdService $service,
    ) {}

    public function name(): string
    {
        return 'messagebird_list_numbers';
    }

    public function description(): string
    {
        return 'List purchased phone numbers in your MessageBird account. Supports filtering by country code and number type.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of numbers to return (default: 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'country_code' => ['type' => 'string', 'description' => 'Filter by ISO 3166-1 alpha-2 country code (e.g., "NL", "US", "GB").'],
            'number_type' => ['type' => 'string', 'description' => 'Filter by number type: mobile, landline.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $countryCode = $args['country_code'] ?? null;
            $numberType = $args['number_type'] ?? null;

            $result = $this->service->listNumbers($limit, $offset, $countryCode, $numberType);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
