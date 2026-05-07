<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create an inbound attachment download token.
 */
class BrevoCreateInboundAttachmentDownloadToken extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_inbound_attachment_download_token';

    protected string $toolDescription = 'Create an inbound attachment download token.';

    protected string $method = 'POST';

    protected string $path = '/inbound/attachments/downloadToken';

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
