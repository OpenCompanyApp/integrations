<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Upload an image for email campaigns.
 */
class BrevoUploadEmailCampaignImage extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_upload_email_campaign_image';

    protected string $toolDescription = 'Upload an image for email campaigns.';

    protected string $method = 'POST';

    protected string $path = '/emailCampaigns/images';

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
