<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleSlidesListSlides implements Tool
{
    public function __construct(
        private GoogleSlidesService $service,
    ) {}

    public function name(): string
    {
        return 'gslides_list_slides';
    }

    public function description(): string
    {
        return 'List all slides in a Google Slides presentation. Returns slide object IDs and thumbnails.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The presentation ID.'],
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of slides to return per page.'],
            'pageToken' => ['type' => 'string', 'description' => 'Token for the next page of results from a previous response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Slides integration is not configured.');
            }

            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 20;
            $pageToken = $args['pageToken'] ?? null;

            $result = $this->service->listSlides($args['id'], $pageSize, $pageToken);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
