<?php

namespace OpenCompany\Integrations\Canva\Tools;

use OpenCompany\Integrations\Canva\CanvaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CanvaCreateDesign implements Tool
{
    public function __construct(
        private CanvaService $service,
    ) {}

    public function name(): string
    {
        return 'canva_create_design';
    }

    public function description(): string
    {
        return 'Create a new design in Canva. Specify a title and optionally a type (e.g., "presentation", "poster") and dimensions (width/height in pixels).';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title for the new design.'],
            'type' => ['type' => 'string', 'description' => 'The type of design to create (e.g., "presentation", "poster", "social_media", "video", "document").'],
            'width' => ['type' => 'integer', 'description' => 'Width of the design in pixels.'],
            'height' => ['type' => 'integer', 'description' => 'Height of the design in pixels.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Canva integration is not configured.');
            }

            $result = $this->service->createDesign(
                title: $args['title'],
                type: $args['type'] ?? null,
                width: isset($args['width']) ? (int) $args['width'] : null,
                height: isset($args['height']) ? (int) $args['height'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
