<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleSlidesGetSlide implements Tool
{
    public function __construct(
        private GoogleSlidesService $service,
    ) {}

    public function name(): string
    {
        return 'gslides_get_slide';
    }

    public function description(): string
    {
        return 'Get details of a specific slide (page) in a Google Slides presentation, including all page elements and their properties.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The presentation ID.'],
            'page' => ['type' => 'string', 'required' => true, 'description' => 'The slide (page) object ID.'],
            'objectIdField' => ['type' => 'string', 'description' => 'The field to use for resolving object IDs in the response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Slides integration is not configured.');
            }

            $objectIdField = $args['objectIdField'] ?? null;

            $result = $this->service->getSlide($args['id'], $args['page'], $objectIdField);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
