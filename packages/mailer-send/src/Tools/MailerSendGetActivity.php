<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve one MailerSend activity event. */
class MailerSendGetActivity extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_activity';
    protected string $toolDescription = 'Get one MailerSend activity event by ID.';
    protected string $path = '/activities/{activity_id}';
    protected array $required = ['activity_id'];
    protected array $parameters = [
        'activity_id' => ['type' => 'string', 'required' => true, 'description' => 'Activity ID.'],
    ];
}
