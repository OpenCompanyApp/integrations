<?php

namespace OpenCompany\Integrations\Sendy\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sendy\SendyService;

/**
 * Retrieve a subscriber's status in a Sendy list.
 *
 * Returns statuses such as Subscribed, Unsubscribed, Unconfirmed, Bounced, Soft bounced, or Complained.
 */
class SendySubscriptionStatus implements Tool
{
    /**
     * @param  SendyService  $service  The Sendy API client
     */
    public function __construct(
        private SendyService $service,
    ) {}

    public function name(): string
    {
        return 'sendy_subscription_status';
    }

    public function description(): string
    {
        return 'Get the current subscription status for an email address in a Sendy list.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'Encrypted list ID.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber email address to check.'],
        ];
    }

    /**
     * Get subscription status.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Sendy integration is not configured.');
            }

            return ToolResult::success($this->service->getSubscriptionStatus((string) ($args['list_id'] ?? ''), (string) ($args['email'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
