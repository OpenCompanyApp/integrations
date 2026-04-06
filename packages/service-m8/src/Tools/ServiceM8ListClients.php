<?php

namespace OpenCompany\Integrations\ServiceM8\Tools;

use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List clients from ServiceM8.
 *
 * Returns a list of clients with contact details, addresses, and metadata.
 */
class ServiceM8ListClients implements Tool
{
    public function __construct(
        private ServiceM8Service $service,
    ) {}

    public function name(): string
    {
        return 'servicem8_list_clients';
    }

    public function description(): string
    {
        return 'List clients from ServiceM8. Returns client details including name, email, phone, and address. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of clients to return per page.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of records to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ServiceM8 integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listClients($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
