<?php

namespace OpenCompany\Integrations\Novu\Tools;

use OpenCompany\Integrations\Novu\NovuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NovuListSubscribers implements Tool
{
    public function __construct(
        private NovuService $service,
    ) {}

    public function name(): string
    {
        return 'novu_list_subscribers';
    }

    public function description(): string
    {
        return 'List subscribers from Novu. Returns a paginated list of all notification subscribers with their details.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (0-based, default: 0).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of subscribers per page (default: 10, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Novu integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 0;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;

            $result = $this->service->listSubscribers($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
