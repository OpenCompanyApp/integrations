<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create an email campaign.
 */
class BrevoCreateEmailCampaign extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_email_campaign';

    protected string $toolDescription = 'Create an email campaign.';

    protected string $method = 'POST';

    protected string $path = '/emailCampaigns';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
