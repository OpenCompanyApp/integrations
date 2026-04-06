<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleSlidesCreatePresentation implements Tool
{
    public function __construct(
        private GoogleSlidesService $service,
    ) {}

    public function name(): string
    {
        return 'gslides_create_presentation';
    }

    public function description(): string
    {
        return 'Create a new, blank Google Slides presentation with a given title.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title for the new presentation.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Slides integration is not configured.');
            }

            $result = $this->service->createPresentation($args['title']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
