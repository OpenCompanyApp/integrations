<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single entry by its ID from the Contentful space.
 */
class ContentfulGetEntry implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_get_entry';
    }

    public function description(): string
    {
        return <<<'MD'
        Get detailed information about a specific entry by its ID.
        Returns all localized field values, content type, version, and timestamps.
        MD;
    }

    public function parameters(): array
    {
        return [
            'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the entry to retrieve.'],
        ];
    }

    /**
     * Get an entry by ID.
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

            $result = $this->service->getEntry($entryId);

            return ToolResult::success([
                'id' => $result['sys']['id'] ?? '',
                'content_type' => $result['sys']['contentType']['sys']['id'] ?? '',
                'created_at' => $result['sys']['createdAt'] ?? null,
                'updated_at' => $result['sys']['updatedAt'] ?? null,
                'version' => $result['sys']['version'] ?? null,
                'fields' => $result['fields'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
