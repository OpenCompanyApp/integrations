<?php

namespace OpenCompany\Integrations\Sinch\Tools;

use OpenCompany\Integrations\Sinch\SinchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SinchListCalls implements Tool
{
    public function __construct(
        private SinchService $service,
    ) {}

    public function name(): string
    {
        return 'sinch_list_calls';
    }

    public function description(): string
    {
        return 'List call history records from Sinch. Supports filtering by caller and callee phone numbers with pagination.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 0).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 30).'],
            'from' => ['type' => 'string', 'description' => 'Filter by caller phone number in E.164 format.'],
            'to' => ['type' => 'string', 'description' => 'Filter by callee phone number in E.164 format.'],
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
            $from = $args['from'] ?? null;
            $to = $args['to'] ?? null;

            $result = $this->service->listCalls($page, $pageSize, $from, $to);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
