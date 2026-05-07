<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve a MailerSend inbound route. */
class MailerSendGetInboundRoute extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_inbound_route';
    protected string $toolDescription = 'Get one MailerSend inbound route by ID.';
    protected string $path = '/inbound/{inbound_id}';
    protected array $required = ['inbound_id'];
    protected array $parameters = [
        'inbound_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbound route ID.'],
    ];
}
