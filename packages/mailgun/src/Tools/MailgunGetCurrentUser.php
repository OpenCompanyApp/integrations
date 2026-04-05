<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get Mailgun account info by fetching the domains list.
 *
 * This serves as a health check and returns the list of domains associated with the account.
 */
class MailgunGetCurrentUser implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_get_current_user';
    }

    public function description(): string
    {
        return 'Get Mailgun account info (domains list). Useful as a health check for the Mailgun connection.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get Mailgun account info by fetching the domains list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
