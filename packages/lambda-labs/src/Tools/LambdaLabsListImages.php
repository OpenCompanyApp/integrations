<?php

namespace OpenCompany\Integrations\LambdaLabs\Tools;

use OpenCompany\Integrations\LambdaLabs\LambdaLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LambdaLabsListImages implements Tool
{
    public function __construct(
        private LambdaLabsService $service,
    ) {}

    public function name(): string
    {
        return 'lambda_labs_list_images';
    }

    public function description(): string
    {
        return 'List all available machine images on Lambda Labs. Returns image IDs, names, and descriptions for OS templates and custom images.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lambda Labs integration is not configured.');
            }

            $result = $this->service->listImages();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
