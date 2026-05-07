<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** List unsubscribed recipients. */
class MailerSendListUnsubscribes extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_list_unsubscribes';
    protected string $toolDescription = 'List unsubscribed recipients from MailerSend suppressions.';
    protected string $path = '/suppressions/unsubscribes';
    protected array $queryParams = ['domain_id', 'limit', 'page'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'description' => 'Optional domain ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Page size.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
    ];
}
