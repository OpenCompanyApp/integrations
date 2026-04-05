<?php

namespace OpenCompany\Integrations\GetResponse\Tools;

use OpenCompany\Integrations\GetResponse\GetResponseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GetResponseListContacts implements Tool
{
    public function __construct(
        private GetResponseService $service,
    ) {}

    public function name(): string
    {
        return 'getresponse_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts in your GetResponse account. Returns paginated results with contact details including email, name, and campaign.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based). Default: 1.'],
            'perPage' => ['type' => 'integer', 'description' => 'Number of contacts per page (max 1000). Default: 50.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GetResponse integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['perPage']) ? (int) $args['perPage'] : 50;

            $result = $this->service->listContacts($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
