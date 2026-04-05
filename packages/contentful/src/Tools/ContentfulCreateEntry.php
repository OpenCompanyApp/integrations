<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new entry of a given content type in the Contentful space.
 */
class ContentfulCreateEntry implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_create_entry';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new entry in Contentful. Specify the content type ID and provide field values
        as a JSON object. Fields must be localized, e.g. {"title": {"en-US": "My Title"}}.
        The entry is created as a draft; use the publish tool to publish it.
        MD;
    }

    public function parameters(): array
    {
        return [
            'content_type_id' => ['type' => 'string', 'required' => true, 'description' => 'The content type ID for the new entry.'],
            'fields' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of localized field values. E.g. {"title": {"en-US": "Hello"}, "body": {"en-US": "World"}}.'],
        ];
    }

    /**
     * Create an entry with localized field values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (content_type_id, fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Contentful integration is not configured.');
            }

            $contentTypeId = $args['content_type_id'] ?? '';

            if (empty($contentTypeId)) {
                return ToolResult::error('content_type_id is required.');
            }

            $fieldsRaw = $args['fields'] ?? '';
            if (empty($fieldsRaw)) {
                return ToolResult::error('fields is required.');
            }

            $fields = is_string($fieldsRaw) ? json_decode($fieldsRaw, true) : $fieldsRaw;
            if (json_last_error() !== JSON_ERROR_NONE) {
                return ToolResult::error('Invalid JSON in fields: ' . json_last_error_msg());
            }

            $result = $this->service->createEntry($contentTypeId, ['fields' => $fields]);

            return ToolResult::success([
                'id' => $result['sys']['id'] ?? '',
                'content_type' => $result['sys']['contentType']['sys']['id'] ?? '',
                'version' => $result['sys']['version'] ?? null,
                'created_at' => $result['sys']['createdAt'] ?? null,
                'fields' => $result['fields'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
