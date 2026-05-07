<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Send an SMS campaign immediately.
 */
class BrevoSendSmsCampaignNow extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_send_sms_campaign_now';

    protected string $toolDescription = 'Send an SMS campaign immediately.';

    protected string $method = 'POST';

    protected string $path = '/smsCampaigns/{campaign_id}/sendNow';

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
