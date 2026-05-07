<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * Search Cloudinary assets with the Admin API expression language.
 */
class CloudinarySearchResources extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_search_resources';
    }

    public function description(): string
    {
        return 'Search Cloudinary assets using the Admin API search expression language.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Query parameters such as expression, sort_by, max_results, next_cursor, aggregate, with_field.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->searchResources($this->params($args));
    }
}
