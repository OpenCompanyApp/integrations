<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Download an inbound attachment by download token.
 */
class BrevoDownloadInboundAttachment extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_download_inbound_attachment';

    protected string $toolDescription = 'Download an inbound attachment by download token.';

    protected string $method = 'GET';

    protected string $path = '/inbound/attachments/{download_token}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'download_token' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Download token.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'download_token',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
