<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Delete a MailerSend inbound route. */
class MailerSendDeleteInboundRoute extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_delete_inbound_route';
    protected string $toolDescription = 'Delete a MailerSend inbound route by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/inbound/{inbound_id}';
    protected array $required = ['inbound_id'];
    protected array $parameters = [
        'inbound_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbound route ID.'],
    ];
}
