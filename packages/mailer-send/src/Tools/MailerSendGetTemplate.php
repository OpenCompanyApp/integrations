<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve one MailerSend template. */
class MailerSendGetTemplate extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_template';
    protected string $toolDescription = 'Get one MailerSend template by ID.';
    protected string $path = '/templates/{template_id}';
    protected array $required = ['template_id'];
    protected array $parameters = [
        'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID.'],
    ];
}
