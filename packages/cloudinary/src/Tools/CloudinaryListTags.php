<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * List tags used by Cloudinary assets.
 */
class CloudinaryListTags extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_list_tags';
    }

    public function description(): string
    {
        return 'List tag names used by Cloudinary assets for a resource type.';
    }

    public function parameters(): array
    {
        return [
            'resource_type' => ['type' => 'string', 'description' => 'Resource type: image, video, or raw. Default: image.'],
            'params' => ['type' => 'object', 'description' => 'Optional prefix, max_results, and next_cursor.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listTags((string) ($args['resource_type'] ?? 'image'), $this->params($args));
    }
}
