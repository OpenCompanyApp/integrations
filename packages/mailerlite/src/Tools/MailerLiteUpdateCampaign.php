<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a MailerLite campaign.
 */
class MailerLiteUpdateCampaign extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_update_campaign';
    }

    public function description(): string
    {
        return 'Update a campaign. Use payload for the full MailerLite update body.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Campaign update payload.'],
        ];
    }

    /**
     * Execute the campaign update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateCampaign(
            $this->required($args, 'campaign_id'),
            $this->required($args, 'payload'),
        ));
    }
}
