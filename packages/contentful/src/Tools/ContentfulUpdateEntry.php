<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing entry in the Contentful space with optimistic locking.
 */
class ContentfulUpdateEntry implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_update_entry';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing entry's field values. Requires the current version number for optimistic locking.
        Fields must be localized, e.g. {"title": {"en-US": "Updated Title"}}.
        The version is sent as the X-Contentful-Version header.
        MD;
    }

    public function parameters(): array
    {
        return [
            'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the entry to update.'],
            'fields' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of localized field values to update. E.g. {"title": {"en-US": "New Title"}}.'],
            'version' => ['type' => 'integer', 'required' => true, 'description' => 'Current version of the entry (required for optimistic locking). Get this from the entry\'s sys.version.'],
        ];
    }

    /**
     * Update an entry with new field values and optimistic locking.
     *
     * @param  array<string, mixed>  $args  Tool arguments (entry_id, fields, version)
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

            $fieldsRaw = $args['fields'] ?? '';
            if (empty($fieldsRaw)) {
                return ToolResult::error('fields is required.');
            }

            $fields = is_string($fieldsRaw) ? json_decode($fieldsRaw, true) : $fieldsRaw;
            if (json_last_error() !== JSON_ERROR_NONE) {
                return ToolResult::error('Invalid JSON in fields: ' . json_last_error_msg());
            }

            $result = $this->service->updateEntry($entryId, (int) $version, ['fields' => $fields]);

            return ToolResult::success([
                'id' => $result['sys']['id'] ?? '',
                'version' => $result['sys']['version'] ?? null,
                'updated_at' => $result['sys']['updatedAt'] ?? null,
                'fields' => $result['fields'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
