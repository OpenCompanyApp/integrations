<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailgunGetDomain implements Tool
{
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_get_domain';
    }

    public function description(): string
    {
        return 'Get details and DNS records for a specific Mailgun domain.';
    }

    public function parameters(): array
    {
        return [
            'domain' => ['type' => 'string', 'description' => 'The domain name to retrieve. Defaults to the configured sending domain.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $domainName = $args['domain'] ?? '';

            if (empty($domainName)) {
                $domainName = $this->service->getConfiguredDomain();
            }

            if (empty($domainName)) {
                return ToolResult::error('Domain name is required. Pass the "domain" parameter or configure a default sending domain.');
            }

            $result = $this->service->getDomain($domainName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
