<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** List MailerSend webhooks. */
class MailerSendListWebhooks extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_list_webhooks';
    protected string $toolDescription = 'List MailerSend webhooks, optionally filtered by domain.';
    protected string $path = '/webhooks';
    protected array $queryParams = ['domain_id', 'limit', 'page'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'description' => 'Optional domain ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Page size.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
    ];
}
