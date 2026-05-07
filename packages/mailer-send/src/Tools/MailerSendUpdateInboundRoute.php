<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Update a MailerSend inbound route. */
class MailerSendUpdateInboundRoute extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_update_inbound_route';
    protected string $toolDescription = 'Update a MailerSend inbound email route.';
    protected string $method = 'PUT';
    protected string $path = '/inbound/{inbound_id}';
    protected array $required = ['inbound_id'];
    protected array $bodyParams = ['name', 'domain_enabled', 'inbound_domain', 'inbound_priority', 'catch_filter', 'catch_type', 'match_filter', 'match_type', 'forwards'];
    protected array $parameters = [
        'inbound_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbound route ID.'],
        'name' => ['type' => 'string', 'description' => 'Inbound route name.'],
        'domain_enabled' => ['type' => 'boolean', 'description' => 'Enable inbound domain handling.'],
        'inbound_domain' => ['type' => 'string', 'description' => 'Inbound domain.'],
        'inbound_priority' => ['type' => 'integer', 'description' => 'Inbound route priority from 0 to 100.'],
        'catch_filter' => ['type' => 'object', 'description' => 'Catch filter object.'],
        'catch_type' => ['type' => 'string', 'description' => 'Catch type, such as all or one.'],
        'match_filter' => ['type' => 'object', 'description' => 'Match filter object.'],
        'match_type' => ['type' => 'string', 'description' => 'Match type, such as all or one.'],
        'forwards' => ['type' => 'array', 'description' => 'Forward targets.', 'items' => ['type' => 'object']],
    ];
}
