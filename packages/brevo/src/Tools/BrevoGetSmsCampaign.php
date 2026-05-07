<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get an SMS campaign.
 */
class BrevoGetSmsCampaign extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_sms_campaign';

    protected string $toolDescription = 'Get an SMS campaign.';

    protected string $method = 'GET';

    protected string $path = '/smsCampaigns/{campaign_id}';

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
