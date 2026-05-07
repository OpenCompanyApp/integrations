<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * List subfolders under a Cloudinary folder path.
 */
class CloudinaryListSubfolders extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_list_subfolders';
    }

    public function description(): string
    {
        return 'List subfolders under a Cloudinary folder path.';
    }

    public function parameters(): array
    {
        return [
            'folder' => ['type' => 'string', 'required' => true, 'description' => 'Parent folder path.'],
            'params' => ['type' => 'object', 'description' => 'Optional max_results and next_cursor.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listSubfolders($this->stringArg($args, 'folder'), $this->params($args));
    }
}
