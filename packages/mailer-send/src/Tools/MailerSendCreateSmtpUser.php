<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Create an SMTP user for a MailerSend domain. */
class MailerSendCreateSmtpUser extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_create_smtp_user';
    protected string $toolDescription = 'Create an SMTP user for a MailerSend domain.';
    protected string $method = 'POST';
    protected string $path = '/domains/{domain_id}/smtp-users';
    protected array $required = ['domain_id', 'name'];
    protected array $bodyParams = ['name', 'enabled'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'SMTP user name.'],
        'enabled' => ['type' => 'boolean', 'description' => 'Whether the SMTP user is enabled.'],
    ];
}
