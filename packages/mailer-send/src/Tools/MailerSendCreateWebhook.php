<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Create a MailerSend webhook. */
class MailerSendCreateWebhook extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_create_webhook';
    protected string $toolDescription = 'Create a MailerSend webhook for selected events.';
    protected string $method = 'POST';
    protected string $path = '/webhooks';
    protected array $required = ['url', 'name', 'events', 'domain_id'];
    protected array $bodyParams = ['url', 'name', 'events', 'domain_id', 'enabled'];
    protected array $parameters = [
        'url' => ['type' => 'string', 'required' => true, 'description' => 'Webhook destination URL.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Webhook name.'],
        'events' => ['type' => 'array', 'required' => true, 'description' => 'Webhook event names.', 'items' => ['type' => 'string']],
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'enabled' => ['type' => 'boolean', 'description' => 'Whether the webhook is enabled.'],
    ];
}
