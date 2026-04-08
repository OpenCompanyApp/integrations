<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\Integrations\Sendgrid\SendgridService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SendgridListContacts implements Tool
{
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts in your SendGrid marketing contacts database. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of contacts to return per page (default: 50, max: 100).'],
            'page_token' => ['type' => 'string', 'description' => 'Token for the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $params = [];
            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }
            if (isset($args['page_token'])) {
                $params['page_token'] = $args['page_token'];
            }

            $result = $this->service->listContacts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
