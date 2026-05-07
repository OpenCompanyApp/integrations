<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** List recipients on hold. */
class MailerSendListOnHold extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_list_on_hold';
    protected string $toolDescription = 'List recipients on MailerSend on-hold suppression list.';
    protected string $path = '/suppressions/on-hold-list';
    protected array $queryParams = ['domain_id', 'limit', 'page'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'description' => 'Optional domain ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Page size.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
    ];
}
