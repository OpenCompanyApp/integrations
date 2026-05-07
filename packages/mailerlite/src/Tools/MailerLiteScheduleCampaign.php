<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Schedule a MailerLite campaign for sending.
 */
class MailerLiteScheduleCampaign extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_schedule_campaign';
    }

    public function description(): string
    {
        return 'Schedule a campaign. Use payload for MailerLite scheduling fields.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.'],
            'payload' => ['type' => 'object', 'description' => 'Schedule payload, such as delivery time or immediate-send settings.'],
        ];
    }

    /**
     * Execute the campaign scheduling.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->scheduleCampaign(
            $this->required($args, 'campaign_id'),
            $this->payload($args),
        ));
    }
}
