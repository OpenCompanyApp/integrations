<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Delete a Typefully v2 draft.
 *
 * Removes the draft from the specified social set.
 */
class TypefullyDeleteDraft implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_delete_draft';
    }

    public function description(): string
    {
        return 'Delete a Typefully draft by social set ID and draft ID.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'draft_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully draft ID.'],
        ];
    }

    /**
     * Delete a draft.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $this->service->deleteDraft($args['social_set_id'] ?? '', $args['draft_id'] ?? '');

            return ToolResult::success(['deleted' => true, 'draft_id' => $args['draft_id'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
