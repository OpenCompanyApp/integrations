<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Add recipients to MailerSend unsubscribe suppressions. */
class MailerSendAddUnsubscribes extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_add_unsubscribes';
    protected string $toolDescription = 'Set one or more recipient emails as unsubscribed.';
    protected string $method = 'POST';
    protected string $path = '/suppressions/unsubscribes';
    protected array $required = ['domain_id', 'recipients'];
    protected array $bodyParams = ['domain_id', 'recipients'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'recipients' => ['type' => 'array', 'required' => true, 'description' => 'Recipient email addresses.', 'items' => ['type' => 'string']],
    ];
}
