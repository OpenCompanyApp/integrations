<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel a queued MailerLite campaign send.
 */
class MailerLiteCancelCampaign extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_cancel_campaign';
    }

    public function description(): string
    {
        return 'Cancel a campaign send when the campaign is still in a cancelable state.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.'],
        ];
    }

    /**
     * Execute the campaign cancellation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->cancelCampaign($this->required($args, 'campaign_id')));
    }
}
