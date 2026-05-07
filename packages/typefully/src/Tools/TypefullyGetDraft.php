<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Get a Typefully v2 draft.
 *
 * Draft IDs are scoped under a social set.
 */
class TypefullyGetDraft implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_get_draft';
    }

    public function description(): string
    {
        return 'Get one Typefully draft by social set ID and draft ID.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'draft_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully draft ID.'],
        ];
    }

    /**
     * Get one draft.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            return ToolResult::success($this->service->getDraft($args['social_set_id'] ?? '', $args['draft_id'] ?? ''));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
