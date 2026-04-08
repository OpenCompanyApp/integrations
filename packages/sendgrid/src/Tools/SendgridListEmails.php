<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\Integrations\Sendgrid\SendgridService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SendgridListEmails implements Tool
{
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_list_emails';
    }

    public function description(): string
    {
        return 'List emails in your SendGrid account. Supports filtering by query and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of emails to return (default: 20, max: 100).'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter emails (e.g., "subject=\"Welcome\"").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }

            $result = $this->service->listEmails($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
