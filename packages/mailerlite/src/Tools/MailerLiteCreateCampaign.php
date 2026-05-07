<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a MailerLite campaign.
 */
class MailerLiteCreateCampaign extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_create_campaign';
    }

    public function description(): string
    {
        return 'Create a campaign. Use payload for the full MailerLite campaign body including emails, groups, segments, and settings.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Campaign creation payload.'],
        ];
    }

    /**
     * Execute the campaign creation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createCampaign($this->required($args, 'payload')));
    }
}
