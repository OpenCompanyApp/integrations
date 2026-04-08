<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single content type by its ID from the Contentful space.
 */
class ContentfulGetContentType implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_get_content_type';
    }

    public function description(): string
    {
        return <<<'MD'
        Get detailed information about a specific content type by its ID.
        Returns the content type name, description, display field, and full field definitions.
        MD;
    }

    public function parameters(): array
    {
        return [
            'content_type_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the content type to retrieve.'],
        ];
    }

    /**
     * Get a content type by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (content_type_id)
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

            $result = $this->service->getContentType($contentTypeId);

            $fields = [];
            foreach ($result['fields'] ?? [] as $field) {
                $fields[] = [
                    'id' => $field['id'] ?? '',
                    'name' => $field['name'] ?? '',
                    'type' => $field['type'] ?? '',
                    'required' => $field['required'] ?? false,
                    'localized' => $field['localized'] ?? false,
                ];
            }

            return ToolResult::success([
                'id' => $result['sys']['id'] ?? '',
                'name' => $result['name'] ?? '',
                'description' => $result['description'] ?? '',
                'display_field' => $result['displayField'] ?? '',
                'fields' => $fields,
                'version' => $result['sys']['version'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
