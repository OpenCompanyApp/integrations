<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Delete one MailerSend template. */
class MailerSendDeleteTemplate extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_delete_template';
    protected string $toolDescription = 'Delete a MailerSend template by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/templates/{template_id}';
    protected array $required = ['template_id'];
    protected array $parameters = [
        'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID.'],
    ];
}
