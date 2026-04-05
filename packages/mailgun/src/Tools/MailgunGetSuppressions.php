<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get bounces (suppressions) for a Mailgun domain.
 *
 * Returns a list of bounced email addresses with their bounce codes and error messages.
 */
class MailgunGetSuppressions implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_get_suppressions';
    }

    public function description(): string
    {
        return 'Get bounces (suppressions) for a Mailgun domain. Returns bounced addresses with codes and error messages.';
    }

    public function parameters(): array
    {
        return [
            'domain' => ['type' => 'string', 'description' => 'Domain to get suppressions for. Defaults to the configured sending domain.'],
            'limit'  => ['type' => 'integer', 'description' => 'Maximum number of suppressions to return (default 100).'],
        ];
    }

    /**
     * Get bounces (suppressions) for a Mailgun domain.
     *
     * @param  array<string, mixed>  $args  Tool arguments (domain, limit)
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

            $params = [];

            if (! empty($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->getSuppressions($domain, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
