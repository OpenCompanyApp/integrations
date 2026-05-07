<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Create a MailerSend inbound route. */
class MailerSendCreateInboundRoute extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_create_inbound_route';
    protected string $toolDescription = 'Create an inbound email route for a MailerSend domain.';
    protected string $method = 'POST';
    protected string $path = '/inbound';
    protected array $required = ['domain_id', 'name', 'domain_enabled', 'inbound_domain', 'inbound_priority', 'catch_filter', 'match_filter', 'forwards'];
    protected array $bodyParams = ['domain_id', 'name', 'domain_enabled', 'inbound_domain', 'inbound_priority', 'catch_filter', 'catch_type', 'match_filter', 'match_type', 'forwards'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Inbound route name.'],
        'domain_enabled' => ['type' => 'boolean', 'required' => true, 'description' => 'Enable inbound domain handling.'],
        'inbound_domain' => ['type' => 'string', 'required' => true, 'description' => 'Inbound domain.'],
        'inbound_priority' => ['type' => 'integer', 'required' => true, 'description' => 'Inbound route priority from 0 to 100.'],
        'catch_filter' => ['type' => 'object', 'required' => true, 'description' => 'Catch filter object.'],
        'catch_type' => ['type' => 'string', 'description' => 'Catch type, such as all or one.'],
        'match_filter' => ['type' => 'object', 'required' => true, 'description' => 'Match filter object.'],
        'match_type' => ['type' => 'string', 'description' => 'Match type, such as all or one.'],
        'forwards' => ['type' => 'array', 'required' => true, 'description' => 'Forward targets.', 'items' => ['type' => 'object']],
    ];
}
