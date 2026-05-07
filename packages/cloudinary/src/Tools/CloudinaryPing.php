<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

/**
 * Ping Cloudinary's Admin API.
 */
class CloudinaryPing extends AbstractCloudinaryTool
{
    public function name(): string
    {
        return 'cloudinary_ping';
    }

    public function description(): string
    {
        return 'Ping Cloudinary servers to test API reachability.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->ping();
    }
}
