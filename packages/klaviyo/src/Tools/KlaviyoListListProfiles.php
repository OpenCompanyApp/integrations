<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * List profiles that belong to a specific Klaviyo list.
 */
class KlaviyoListListProfiles implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_list_list_profiles';
    }

    public function description(): string
    {
        return <<<'MD'
        List profiles that belong to a specific Klaviyo list.
        Returns each profile's ID, email, phone number, name, and custom properties.
        Use cursor-based pagination to iterate through large lists.
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Klaviyo list ID.',
            ],
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

            $listId = $args['list_id'] ?? '';
            if (empty($listId)) {
                return ToolResult::error('The "list_id" parameter is required.');
            }

            $result = $this->service->listListProfiles(
                listId: $listId,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                pageCursor: $args['page_cursor'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
