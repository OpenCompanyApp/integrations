<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** List recipients for a MailerSend domain. */
class MailerSendListDomainRecipients extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_list_domain_recipients';
    protected string $toolDescription = 'List recipients associated with a MailerSend domain.';
    protected string $path = '/domains/{domain_id}/recipients';
    protected array $required = ['domain_id'];
    protected array $queryParams = ['limit', 'page'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Page size.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
    ];
}
