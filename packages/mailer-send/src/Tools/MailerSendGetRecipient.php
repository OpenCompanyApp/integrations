<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve one MailerSend recipient. */
class MailerSendGetRecipient extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_recipient';
    protected string $toolDescription = 'Get one MailerSend recipient by ID.';
    protected string $path = '/recipients/{recipient_id}';
    protected array $required = ['recipient_id'];
    protected array $parameters = [
        'recipient_id' => ['type' => 'string', 'required' => true, 'description' => 'Recipient ID.'],
    ];
}
