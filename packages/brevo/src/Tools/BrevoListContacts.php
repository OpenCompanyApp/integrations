<?php

namespace OpenCompany\Integrations\Brevo\Tools;

use OpenCompany\Integrations\Brevo\BrevoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BrevoListContacts implements Tool
{
    public function __construct(
        private BrevoService $service,
    ) {}

    public function name(): string
    {
        return 'brevo_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts in your Brevo account. Supports pagination and filtering by email or search term.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 50, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of contacts to skip for pagination (default: 0).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter contacts by email or attributes (e.g., "john@example.com").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brevo integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['search'])) {
                $params['search'] = $args['search'];
            }

            $result = $this->service->listContacts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
