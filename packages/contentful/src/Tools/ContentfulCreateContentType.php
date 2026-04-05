<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new content type in the Contentful space.
 */
class ContentfulCreateContentType implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_create_content_type';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new content type in Contentful with a name, display name, optional description,
        and field definitions. Fields are provided as a JSON array of objects with id, name, and type.
        Common field types: Symbol, Text, Integer, Number, Boolean, Date, Location, RichText, Array, Link.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Internal name of the content type (e.g. "blogPost").'],
            'display_name' => ['type' => 'string', 'required' => true, 'description' => 'Human-readable display name (e.g. "Blog Post").'],
            'description' => ['type' => 'string', 'description' => 'Description of the content type.'],
            'fields' => ['type' => 'string', 'required' => true, 'description' => 'JSON array of field definitions. Each field needs id, name, and type. Example: [{"id":"title","name":"Title","type":"Symbol"}].'],
        ];
    }

    /**
     * Create a content type with the given name and field definitions.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, display_name, description, fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Contentful integration is not configured.');
            }

            $name = $args['name'] ?? '';
            $displayName = $args['display_name'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            if (empty($displayName)) {
                return ToolResult::error('display_name is required.');
            }

            $fieldsRaw = $args['fields'] ?? '';
            if (empty($fieldsRaw)) {
                return ToolResult::error('fields is required.');
            }

            $fields = is_string($fieldsRaw) ? json_decode($fieldsRaw, true) : $fieldsRaw;
            if (json_last_error() !== JSON_ERROR_NONE) {
                return ToolResult::error('Invalid JSON in fields: ' . json_last_error_msg());
            }

            $body = [
                'name' => $name,
                'display_name' => $displayName,
                'fields' => $fields,
            ];

            if (isset($args['description'])) {
                $body['description'] = $args['description'];
            }

            $result = $this->service->createContentType($body);

            return ToolResult::success([
                'id' => $result['sys']['id'] ?? '',
                'name' => $result['name'] ?? '',
                'display_name' => $result['display_name'] ?? '',
                'version' => $result['sys']['version'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
