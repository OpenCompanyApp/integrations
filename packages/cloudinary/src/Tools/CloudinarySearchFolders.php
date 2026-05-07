<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * Search Cloudinary asset folders.
 */
class CloudinarySearchFolders extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_search_folders';
    }

    public function description(): string
    {
        return 'Search Cloudinary asset folders with optional expression and pagination parameters.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional expression, sort_by, max_results, and next_cursor.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->searchFolders($this->params($args));
    }
}
