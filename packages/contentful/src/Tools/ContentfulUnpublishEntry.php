<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Unpublish a published entry in the Contentful space.
 */
class ContentfulUnpublishEntry implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_unpublish_entry';
    }

    public function description(): string
    {
        return <<<'MD'
        Unpublish a published entry, reverting it to draft status. Requires the current version number
        for optimistic locking, sent as the X-Contentful-Version header. The entry will no longer be
        visible via the Content Delivery API.
        MD;
    }

    public function parameters(): array
    {
        return [
            'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the entry to unpublish.'],
            'version' => ['type' => 'integer', 'required' => true, 'description' => 'Current version of the entry (required for optimistic locking).'],
        ];
    }

    /**
     * Unpublish an entry by ID with version-based optimistic locking.
     *
     * @param  array<string, mixed>  $args  Tool arguments (entry_id, version)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Contentful integration is not configured.');
            }

            $entryId = $args['entry_id'] ?? '';
            $version = $args['version'] ?? null;

            if (empty($entryId)) {
                return ToolResult::error('entry_id is required.');
            }

            if ($version === null) {
                return ToolResult::error('version is required for optimistic locking.');
            }

            $this->service->unpublishEntry($entryId, (int) $version);

            return ToolResult::success([
                'id' => $entryId,
                'unpublished' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
