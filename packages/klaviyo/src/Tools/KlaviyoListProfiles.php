<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * List Klaviyo profiles with cursor-based pagination.
 */
class KlaviyoListProfiles implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_list_profiles';
    }

    public function description(): string
    {
        return <<<'MD'
        List profiles in Klaviyo with cursor-based pagination.
        Returns each profile's ID, email, phone number, name, and custom properties.
        Use the page_cursor from a previous response to fetch the next page of results.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of profiles to return (default 20, max 100).',
                'default' => 20,
            ],
            'page_cursor' => [
                'type' => 'string',
                'description' => 'Pagination cursor from a previous response to fetch the next page.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Klaviyo integration is not configured.');
            }

            $result = $this->service->listProfiles(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                pageCursor: $args['page_cursor'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
