<?php

namespace OpenCompany\Integrations\Bannerbear\Tools;

use OpenCompany\Integrations\Bannerbear\BannerbearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BannerbearGetTemplate implements Tool
{
    public function __construct(
        private BannerbearService $service,
    ) {}

    public function name(): string
    {
        return 'bannerbear_get_template';
    }

    public function description(): string
    {
        return 'Get details for a specific Bannerbear template, including all available modification layers (text, image, color, etc.). Use this to discover which layer names to use when calling create_image or create_video.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The template UID (e.g., "01H8XYZ..."). Use list_templates to find available templates.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bannerbear integration is not configured.');
            }

            $result = $this->service->getTemplate($args['template_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
