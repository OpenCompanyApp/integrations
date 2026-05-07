<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Add recipients to MailerSend blocklist suppressions. */
class MailerSendAddBlocklistRecipients extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_add_blocklist_recipients';
    protected string $toolDescription = 'Add one or more recipient emails to the blocklist suppression list.';
    protected string $method = 'POST';
    protected string $path = '/suppressions/blocklist';
    protected array $required = ['domain_id', 'recipients'];
    protected array $bodyParams = ['domain_id', 'recipients'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'recipients' => ['type' => 'array', 'required' => true, 'description' => 'Recipient email addresses.', 'items' => ['type' => 'string']],
    ];
}
