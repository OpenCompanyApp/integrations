<?php

namespace OpenCompany\Integrations\Sinch\Tools;

use OpenCompany\Integrations\Sinch\SinchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SinchListApplications implements Tool
{
    public function __construct(
        private SinchService $service,
    ) {}

    public function name(): string
    {
        return 'sinch_list_applications';
    }

    public function description(): string
    {
        return 'List Sinch voice and SMS applications configured in your account. Applications define how calls and messages are routed.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 0).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 30).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sinch integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 0;
            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 30;

            $result = $this->service->listApplications($page, $pageSize);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
