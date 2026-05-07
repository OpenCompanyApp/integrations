<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Delete a MailerSend sending domain. */
class MailerSendDeleteDomain extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_delete_domain';
    protected string $toolDescription = 'Delete a MailerSend sending domain by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/domains/{domain_id}';
    protected array $required = ['domain_id'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
    ];
}
