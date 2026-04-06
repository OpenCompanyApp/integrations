<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleSlidesGetPresentation implements Tool
{
    public function __construct(
        private GoogleSlidesService $service,
    ) {}

    public function name(): string
    {
        return 'gslides_get_presentation';
    }

    public function description(): string
    {
        return 'Get full details of a specific Google Slides presentation, including all slides, page elements, and layout information.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The presentation ID (found in the Google Slides URL or from list_presentations).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Slides integration is not configured.');
            }

            $result = $this->service->getPresentation($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
