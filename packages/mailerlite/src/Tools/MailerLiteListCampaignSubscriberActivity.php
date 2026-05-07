<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscriber activity for a sent MailerLite campaign.
 */
class MailerLiteListCampaignSubscriberActivity extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_campaign_subscriber_activity';
    }

    public function description(): string
    {
        return 'List subscriber activity for a sent campaign, including opens, clicks, bounces, and unsubscribes.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
        ];
    }

    /**
     * Execute the campaign subscriber activity listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listCampaignSubscriberActivity(
            $this->required($args, 'campaign_id'),
            $this->only($args, ['page', 'limit']),
        ));
    }
}
