<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * List published Typefully v2 drafts for a social set.
 *
 * Uses the v2 draft list endpoint with status filtering.
 */
class TypefullyListPublished implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_list_published';
    }

    public function description(): string
    {
        return 'List published Typefully drafts for a social set.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of drafts to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of drafts to skip for pagination.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field such as published_at, created_at, updated_at, or scheduled_date.'],
        ];
    }

    /**
     * List published drafts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $params = ['status' => 'published'];
            foreach (['limit', 'offset', 'sort'] as $field) {
                if (isset($args[$field])) {
                    $params[$field] = $args[$field];
                }
            }

            return ToolResult::success($this->service->listDrafts($args['social_set_id'] ?? '', $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
