<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * List Cloudinary upload presets.
 */
class CloudinaryListUploadPresets extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_list_upload_presets';
    }

    public function description(): string
    {
        return 'List Cloudinary upload presets with pagination.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional max_results and next_cursor.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listUploadPresets($this->params($args));
    }
}
