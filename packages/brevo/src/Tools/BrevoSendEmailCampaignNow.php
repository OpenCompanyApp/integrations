<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Send an email campaign immediately.
 */
class BrevoSendEmailCampaignNow extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_send_email_campaign_now';

    protected string $toolDescription = 'Send an email campaign immediately.';

    protected string $method = 'POST';

    protected string $path = '/emailCampaigns/{campaign_id}/sendNow';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'campaign_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Campaign ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'campaign_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
