<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Delete a MailerSend webhook. */
class MailerSendDeleteWebhook extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_delete_webhook';
    protected string $toolDescription = 'Delete a MailerSend webhook by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/webhooks/{webhook_id}';
    protected array $required = ['webhook_id'];
    protected array $parameters = [
        'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
    ];
}
