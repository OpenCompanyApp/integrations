<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * Delete an empty Cloudinary asset folder.
 */
class CloudinaryDeleteFolder extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_delete_folder';
    }

    public function description(): string
    {
        return 'Delete an empty Cloudinary asset folder.';
    }

    public function parameters(): array
    {
        return [
            'folder' => ['type' => 'string', 'required' => true, 'description' => 'Folder path to delete.'],
            'params' => ['type' => 'object', 'description' => 'Optional delete parameters such as skip_backup.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->deleteFolder($this->stringArg($args, 'folder'), $this->params($args));
    }
}
