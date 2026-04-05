<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Publish a draft or updated entry in the Contentful space.
 */
class ContentfulPublishEntry implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_publish_entry';
    }

    public function description(): string
    {
        return <<<'MD'
        Publish a draft or updated entry. Requires the current version number for optimistic locking,
        sent as the X-Contentful-Version header. After publishing, the entry becomes publicly visible
        via the Content Delivery API.
        MD;
    }

    public function parameters(): array
    {
        return [
            'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the entry to publish.'],
            'version' => ['type' => 'integer', 'required' => true, 'description' => 'Current version of the entry (required for optimistic locking).'],
        ];
    }

    /**
     * Publish an entry by ID with version-based optimistic locking.
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

            $result = $this->service->publishEntry($entryId, (int) $version);

            return ToolResult::success([
                'id' => $result['sys']['id'] ?? '',
                'version' => $result['sys']['version'] ?? null,
                'published_at' => $result['sys']['publishedAt'] ?? null,
                'published_version' => $result['sys']['publishedVersion'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
