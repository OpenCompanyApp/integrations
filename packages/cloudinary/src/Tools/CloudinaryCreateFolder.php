<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * Create a Cloudinary asset folder.
 */
class CloudinaryCreateFolder extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_create_folder';
    }

    public function description(): string
    {
        return 'Create a Cloudinary asset folder.';
    }

    public function parameters(): array
    {
        return [
            'folder' => ['type' => 'string', 'required' => true, 'description' => 'Folder path to create.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->createFolder($this->stringArg($args, 'folder'));
    }
}
