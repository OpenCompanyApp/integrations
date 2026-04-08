<?php

namespace OpenCompany\Integrations\GoToWebinar\Tools;

use OpenCompany\Integrations\GoToWebinar\GoToWebinarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoToWebinarListWebinars implements Tool
{
    public function __construct(
        private GoToWebinarService $service,
    ) {}

    public function name(): string
    {
        return 'gotowebinar_list_webinars';
    }

    public function description(): string
    {
        return 'List webinars from GoTo Webinar. Returns upcoming, in-progress, and past webinars. Use the status parameter to filter by webinar state.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (0-based, default: 0).'],
            'size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 200).'],
            'status' => ['type' => 'string', 'description' => 'Filter by webinar status: "ACTIVE", "IN_SESSION", "ENDED", "CANCELED". Omit to list all.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GoTo Webinar integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 0;
            $size = isset($args['size']) ? (int) $args['size'] : 20;
            $status = $args['status'] ?? null;

            $result = $this->service->listWebinars($page, $size, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
