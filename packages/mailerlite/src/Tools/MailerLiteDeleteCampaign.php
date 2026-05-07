<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a MailerLite campaign.
 */
class MailerLiteDeleteCampaign extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_delete_campaign';
    }

    public function description(): string
    {
        return 'Delete a campaign by ID.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.'],
        ];
    }

    /**
     * Execute the campaign deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteCampaign($this->required($args, 'campaign_id')));
    }
}
