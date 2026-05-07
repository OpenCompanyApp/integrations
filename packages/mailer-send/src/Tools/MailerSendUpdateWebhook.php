<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Update a MailerSend webhook. */
class MailerSendUpdateWebhook extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_update_webhook';
    protected string $toolDescription = 'Update a MailerSend webhook.';
    protected string $method = 'PUT';
    protected string $path = '/webhooks/{webhook_id}';
    protected array $required = ['webhook_id'];
    protected array $bodyParams = ['url', 'name', 'events', 'enabled'];
    protected array $parameters = [
        'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
        'url' => ['type' => 'string', 'description' => 'Webhook destination URL.'],
        'name' => ['type' => 'string', 'description' => 'Webhook name.'],
        'events' => ['type' => 'array', 'description' => 'Webhook event names.', 'items' => ['type' => 'string']],
        'enabled' => ['type' => 'boolean', 'description' => 'Whether the webhook is enabled.'],
    ];
}
