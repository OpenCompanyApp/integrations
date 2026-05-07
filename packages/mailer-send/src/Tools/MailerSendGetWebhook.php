<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve one MailerSend webhook. */
class MailerSendGetWebhook extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_webhook';
    protected string $toolDescription = 'Get one MailerSend webhook by ID.';
    protected string $path = '/webhooks/{webhook_id}';
    protected array $required = ['webhook_id'];
    protected array $parameters = [
        'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
    ];
}
