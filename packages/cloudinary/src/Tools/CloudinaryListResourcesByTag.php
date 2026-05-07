<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * List Cloudinary assets that share a tag.
 */
class CloudinaryListResourcesByTag extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_list_resources_by_tag';
    }

    public function description(): string
    {
        return 'List Cloudinary assets that have a specific tag.';
    }

    public function parameters(): array
    {
        return [
            'tag' => ['type' => 'string', 'required' => true, 'description' => 'Tag name.'],
            'resource_type' => ['type' => 'string', 'description' => 'Resource type: image, video, or raw. Default: image.'],
            'params' => ['type' => 'object', 'description' => 'Optional max_results, next_cursor, and direction.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listResourcesByTag($this->stringArg($args, 'tag'), (string) ($args['resource_type'] ?? 'image'), $this->params($args));
    }
}
