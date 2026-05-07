<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve one SMTP user for a MailerSend domain. */
class MailerSendGetSmtpUser extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_smtp_user';
    protected string $toolDescription = 'Get one MailerSend SMTP user by ID.';
    protected string $path = '/domains/{domain_id}/smtp-users/{smtp_user_id}';
    protected array $required = ['domain_id', 'smtp_user_id'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'smtp_user_id' => ['type' => 'string', 'required' => true, 'description' => 'SMTP user ID.'],
    ];
}
