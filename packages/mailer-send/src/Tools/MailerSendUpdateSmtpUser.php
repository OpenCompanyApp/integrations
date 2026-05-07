<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Update a MailerSend SMTP user. */
class MailerSendUpdateSmtpUser extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_update_smtp_user';
    protected string $toolDescription = 'Update a MailerSend SMTP user.';
    protected string $method = 'PUT';
    protected string $path = '/domains/{domain_id}/smtp-users/{smtp_user_id}';
    protected array $required = ['domain_id', 'smtp_user_id'];
    protected array $bodyParams = ['name', 'enabled'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'smtp_user_id' => ['type' => 'string', 'required' => true, 'description' => 'SMTP user ID.'],
        'name' => ['type' => 'string', 'description' => 'SMTP user name.'],
        'enabled' => ['type' => 'boolean', 'description' => 'Whether the SMTP user is enabled.'],
    ];
}
