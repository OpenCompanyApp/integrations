<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve verification status for a MailerSend domain. */
class MailerSendGetDomainVerificationStatus extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_domain_verification_status';
    protected string $toolDescription = 'Get MailerSend domain verification status.';
    protected string $path = '/domains/{domain_id}/verify';
    protected array $required = ['domain_id'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
    ];
}
