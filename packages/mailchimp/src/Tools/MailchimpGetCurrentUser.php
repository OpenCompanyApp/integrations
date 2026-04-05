<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Get the authenticated Mailchimp user's account information.
 */
class MailchimpGetCurrentUser implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the authenticated Mailchimp user's account information.
        Returns account name, email, total subscribers, industry stats, and plan details.
        Useful for verifying the connection and understanding the account scope.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailchimp integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
