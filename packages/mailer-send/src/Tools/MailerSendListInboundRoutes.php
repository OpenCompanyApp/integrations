<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** List MailerSend inbound routes. */
class MailerSendListInboundRoutes extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_list_inbound_routes';
    protected string $toolDescription = 'List MailerSend inbound email routes.';
    protected string $path = '/inbound';
    protected array $queryParams = ['domain_id', 'limit', 'page'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'description' => 'Optional domain ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Page size.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
    ];
}
