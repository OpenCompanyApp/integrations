<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * Call a read-only Cloudinary Admin API endpoint.
 */
class CloudinaryApiGet extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_api_get';
    }

    public function description(): string
    {
        return 'Call a read-only Cloudinary Admin API GET endpoint not covered by a first-class tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Admin API path such as /resources/search or /usage.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->apiGet($this->stringArg($args, 'path'), $this->params($args));
    }
}
