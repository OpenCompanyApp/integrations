<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Update a Typefully v2 draft.
 *
 * Sends only provided fields to the draft PATCH endpoint.
 */
class TypefullyUpdateDraft implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_update_draft';
    }

    public function description(): string
    {
        return 'Update a Typefully draft, including platforms, publish_at, tags, share, or title.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'draft_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully draft ID.'],
            'platforms' => ['type' => 'object', 'description' => 'Updated v2 platforms payload.'],
            'publish_at' => ['type' => 'string', 'description' => 'ISO 8601 datetime, "now", or "next-free-slot".'],
            'title' => ['type' => 'string', 'description' => 'Updated internal title.'],
            'tags' => ['type' => 'array', 'description' => 'Updated tag slugs.', 'items' => ['type' => 'string']],
            'share' => ['type' => 'boolean', 'description' => 'Whether public sharing is enabled.'],
            'reply_to' => ['type' => 'string', 'description' => 'Reply target reference.'],
        ];
    }

    /**
     * Update a draft.
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
            $draftId = $args['draft_id'] ?? '';
            unset($args['social_set_id'], $args['draft_id']);

            if ($args === []) {
                return ToolResult::error('Provide at least one field to update.');
            }

            return ToolResult::success($this->service->updateDraft($socialSetId, $draftId, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
