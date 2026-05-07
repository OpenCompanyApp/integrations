<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update an email campaign.
 */
class BrevoUpdateEmailCampaign extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_email_campaign';

    protected string $toolDescription = 'Update an email campaign.';

    protected string $method = 'PUT';

    protected string $path = '/emailCampaigns/{campaign_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'campaign_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Campaign ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
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
    'payload',
];
}
