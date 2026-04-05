<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a single Mailgun domain.
 *
 * Returns domain info including DNS records, state, and created_at timestamp.
 */
class MailgunGetDomain implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_get_domain';
    }

    public function description(): string
    {
        return 'Get details for a Mailgun domain including DNS records, state, and created_at timestamp.';
    }

    public function parameters(): array
    {
        return [
            'domain' => ['type' => 'string', 'required' => true, 'description' => 'Domain name to look up (e.g. mg.example.com).'],
        ];
    }

    /**
     * Get details for a Mailgun domain.
     *
     * @param  array<string, mixed>  $args  Tool arguments (domain)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $domain = $args['domain'] ?? '';

            if (empty($domain)) {
                return ToolResult::error('domain is required.');
            }

            $result = $this->service->getDomain($domain);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
