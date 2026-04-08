<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete an entry from the Contentful space.
 */
class ContentfulDeleteEntry implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_delete_entry';
    }

    public function description(): string
    {
        return <<<'MD'
        Permanently delete an entry from the Contentful space. The entry must be unpublished
        before it can be deleted. This action is irreversible.
        MD;
    }

    public function parameters(): array
    {
        return [
            'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the entry to delete.'],
        ];
    }

    /**
     * Delete an entry by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (entry_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Contentful integration is not configured.');
            }

            $entryId = $args['entry_id'] ?? '';

            if (empty($entryId)) {
                return ToolResult::error('entry_id is required.');
            }

            $this->service->deleteEntry($entryId);

            return ToolResult::success([
                'id' => $entryId,
                'deleted' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
