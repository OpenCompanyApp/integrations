<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List activity log entries for a MailerLite subscriber.
 */
class MailerLiteListSubscriberActivity extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_subscriber_activity';
    }

    public function description(): string
    {
        return 'List activity log entries for a subscriber with optional log-name, cursor, and limit filters.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber ID.'],
            'filter[log_name]' => ['type' => 'string', 'description' => 'Activity type filter such as email_open, link_click, unsubscribed, or campaign_send.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
        ];
    }

    /**
     * Execute the subscriber activity listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listSubscriberActivity(
            $this->required($args, 'id'),
            $this->only($args, ['filter[log_name]', 'limit', 'page']),
        ));
    }
}
