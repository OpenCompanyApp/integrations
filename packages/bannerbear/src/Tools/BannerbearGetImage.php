<?php

namespace OpenCompany\Integrations\Bannerbear\Tools;

use OpenCompany\Integrations\Bannerbear\BannerbearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BannerbearGetImage implements Tool
{
    public function __construct(
        private BannerbearService $service,
    ) {}

    public function name(): string
    {
        return 'bannerbear_get_image';
    }

    public function description(): string
    {
        return 'Retrieve the status and download URL of a previously created Bannerbear image. Images are generated asynchronously, so poll this endpoint until status is "completed".';
    }

    public function parameters(): array
    {
        return [
            'image_id' => ['type' => 'string', 'required' => true, 'description' => 'The image UID returned by create_image.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bannerbear integration is not configured.');
            }

            $result = $this->service->getImage($args['image_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
