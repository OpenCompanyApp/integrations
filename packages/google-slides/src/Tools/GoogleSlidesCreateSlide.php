<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleSlidesCreateSlide implements Tool
{
    public function __construct(
        private GoogleSlidesService $service,
    ) {}

    public function name(): string
    {
        return 'gslides_create_slide';
    }

    public function description(): string
    {
        return 'Add a new slide to an existing Google Slides presentation. Optionally add text boxes and shapes to the new slide.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The presentation ID.'],
            'pageObjectId' => ['type' => 'string', 'description' => 'Optional custom object ID for the new slide. If omitted, Google will generate one.'],
            'createObject' => ['type' => 'boolean', 'description' => 'Whether to create the slide object (default: true).'],
            'elements' => [
                'type' => 'array',
                'description' => 'Optional array of elements to add to the new slide. Each element has: type ("text" or "shape"), shape (shape type like "RECTANGLE"), text (content string), and style (object with size, transform, font properties).',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Slides integration is not configured.');
            }

            $pageObjectId = $args['pageObjectId'] ?? null;
            $createObject = $args['createObject'] ?? true;
            $slide = [];

            if (isset($args['elements'])) {
                $slide['elements'] = $args['elements'];
            }

            $result = $this->service->createSlide(
                $args['id'],
                $pageObjectId,
                (bool) $createObject,
                $slide,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
