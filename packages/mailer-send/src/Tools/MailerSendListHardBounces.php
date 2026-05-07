<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** List hard-bounced recipients. */
class MailerSendListHardBounces extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_list_hard_bounces';
    protected string $toolDescription = 'List hard-bounced recipients from MailerSend suppressions.';
    protected string $path = '/suppressions/hard-bounces';
    protected array $queryParams = ['domain_id', 'limit', 'page'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'description' => 'Optional domain ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Page size.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
    ];
}
