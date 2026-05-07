<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve DNS records for a MailerSend domain. */
class MailerSendGetDomainDnsRecords extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_domain_dns_records';
    protected string $toolDescription = 'Get DNS records required for a MailerSend domain.';
    protected string $path = '/domains/{domain_id}/dns-records';
    protected array $required = ['domain_id'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
    ];
}
