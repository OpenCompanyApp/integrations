<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * List Typefully drafts for a social set.
 *
 * Supports v2 status, tag, sort, limit, and offset filters.
 */
class TypefullyListDrafts implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_list_drafts';
    }

    public function description(): string
    {
        return 'List Typefully drafts for a social set with optional status, tag, and sorting filters.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'status' => ['type' => 'string', 'description' => 'Draft status filter such as draft, scheduled, or published.'],
            'tags' => ['type' => 'array', 'description' => 'Tag slugs to filter by.', 'items' => ['type' => 'string']],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of drafts to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of drafts to skip.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field such as created_at, updated_at, scheduled_date, or published_at.'],
        ];
    }

    /**
     * List drafts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $socialSetId = $args['social_set_id'] ?? '';
            unset($args['social_set_id']);

            return ToolResult::success($this->service->listDrafts($socialSetId, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
