<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * List Typefully social sets.
 *
 * Social set IDs are required for draft, media, tag, and queue operations.
 */
class TypefullyListSocialSets implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_list_social_sets';
    }

    public function description(): string
    {
        return 'List Typefully social sets available to the authenticated API key.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of social sets to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of social sets to skip for pagination.'],
        ];
    }

    /**
     * List social sets.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            return ToolResult::success($this->service->listSocialSets($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
