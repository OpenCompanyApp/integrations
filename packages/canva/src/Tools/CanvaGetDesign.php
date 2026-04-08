<?php

namespace OpenCompany\Integrations\Canva\Tools;

use OpenCompany\Integrations\Canva\CanvaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CanvaGetDesign implements Tool
{
    public function __construct(
        private CanvaService $service,
    ) {}

    public function name(): string
    {
        return 'canva_get_design';
    }

    public function description(): string
    {
        return 'Get details of a specific Canva design by its ID, including title, type, dimensions, and URLs.';
    }

    public function parameters(): array
    {
        return [
            'design_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the design to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Canva integration is not configured.');
            }

            $result = $this->service->getDesign($args['design_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
