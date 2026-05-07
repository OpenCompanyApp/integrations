<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve one MailerSend sending domain. */
class MailerSendGetDomain extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_domain';
    protected string $toolDescription = 'Get one MailerSend sending domain by ID.';
    protected string $path = '/domains/{domain_id}';
    protected array $required = ['domain_id'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
    ];
}
