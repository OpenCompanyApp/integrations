<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * List Cloudinary named transformations.
 */
class CloudinaryListTransformations extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_list_transformations';
    }

    public function description(): string
    {
        return 'List Cloudinary named transformations with pagination.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional max_results and next_cursor.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listTransformations($this->params($args));
    }
}
