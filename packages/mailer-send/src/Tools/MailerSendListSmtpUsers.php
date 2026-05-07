<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** List SMTP users for a MailerSend domain. */
class MailerSendListSmtpUsers extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_list_smtp_users';
    protected string $toolDescription = 'List SMTP users for a MailerSend domain.';
    protected string $path = '/domains/{domain_id}/smtp-users';
    protected array $required = ['domain_id'];
    protected array $queryParams = ['limit', 'page'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Page size.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
    ];
}
