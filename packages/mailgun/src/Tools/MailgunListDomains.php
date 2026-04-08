<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailgunListDomains implements Tool
{
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_list_domains';
    }

    public function description(): string
    {
        return 'List all domains in your Mailgun account with optional pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of domains to return (default: 100, max: 1000).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of domains to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $params = array_filter([
                'limit' => $args['limit'] ?? null,
                'skip' => $args['skip'] ?? null,
            ], fn($value) => $value !== null);

            $result = $this->service->listDomains($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
