<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleSlidesListPresentations implements Tool
{
    public function __construct(
        private GoogleSlidesService $service,
    ) {}

    public function name(): string
    {
        return 'gslides_list_presentations';
    }

    public function description(): string
    {
        return 'List Google Slides presentations from the user\'s Drive. Returns presentation IDs, titles, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of presentations to return per page (default: 20, max: 100).'],
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

            $result = $this->service->listPresentations($pageSize, $pageToken);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
