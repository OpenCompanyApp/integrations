<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * Get Cloudinary product environment usage data.
 */
class CloudinaryGetUsage extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_get_usage';
    }

    public function description(): string
    {
        return 'Get Cloudinary product environment usage details.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional date parameter in yyyy-mm-dd format.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getUsage($this->params($args));
    }
}
