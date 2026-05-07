<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a MailerLite campaign by ID.
 */
class MailerLiteGetCampaign extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_get_campaign';
    }

    public function description(): string
    {
        return 'Get a campaign by ID.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.'],
        ];
    }

    /**
     * Execute the campaign fetch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getCampaign($this->required($args, 'campaign_id')));
    }
}
