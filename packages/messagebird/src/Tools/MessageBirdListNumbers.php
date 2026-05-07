<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\Integrations\MessageBird\MessageBirdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List purchased MessageBird numbers.
 *
 * Supports official number listing filters and pagination.
 */
class MessageBirdListNumbers implements Tool
{
    /**
     * @param  MessageBirdService  $service  The MessageBird REST API client
     */
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

    /**
     * List numbers.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            $result = $this->service->listNumbers(array_filter([
                'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
                'offset' => isset($args['offset']) ? (int) $args['offset'] : null,
                'country_code' => $args['country_code'] ?? null,
                'number_type' => $args['number_type'] ?? null,
            ], static fn (mixed $value): bool => $value !== null));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
