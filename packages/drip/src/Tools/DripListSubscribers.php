<?php

namespace OpenCompany\Integrations\Drip\Tools;

use OpenCompany\Integrations\Drip\DripService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DripListSubscribers implements Tool
{
    public function __construct(
        private DripService $service,
    ) {}

    public function name(): string
    {
        return 'drip_list_subscribers';
    }

    public function description(): string
    {
        return 'List subscribers in your Drip account. Returns subscriber records including email, status, tags, and custom fields. Paginated — use page and per_page parameters to navigate results.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page, max 1000 (default: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Drip integration is not configured. Provide an API key and account ID.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 100;

            $result = $this->service->listSubscribers($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
