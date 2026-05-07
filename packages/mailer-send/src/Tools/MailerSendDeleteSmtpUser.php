<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Delete a MailerSend SMTP user. */
class MailerSendDeleteSmtpUser extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_delete_smtp_user';
    protected string $toolDescription = 'Delete a MailerSend SMTP user by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/domains/{domain_id}/smtp-users/{smtp_user_id}';
    protected array $required = ['domain_id', 'smtp_user_id'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'smtp_user_id' => ['type' => 'string', 'required' => true, 'description' => 'SMTP user ID.'],
    ];
}
