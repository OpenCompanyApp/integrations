<?php

namespace OpenCompany\Integrations\Bannerbear\Tools;

use OpenCompany\Integrations\Bannerbear\BannerbearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BannerbearListTemplates implements Tool
{
    public function __construct(
        private BannerbearService $service,
    ) {}

    public function name(): string
    {
        return 'bannerbear_list_templates';
    }

    public function description(): string
    {
        return 'List all available Bannerbear templates. Returns template UIDs, names, dimensions, and preview URLs. Use a template UID with create_image or create_video.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bannerbear integration is not configured.');
            }

            $result = $this->service->listTemplates();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
