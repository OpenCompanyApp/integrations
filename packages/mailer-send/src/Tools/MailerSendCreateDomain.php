<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Add a sending domain to MailerSend. */
class MailerSendCreateDomain extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_create_domain';
    protected string $toolDescription = 'Add a sending domain to MailerSend.';
    protected string $method = 'POST';
    protected string $path = '/domains';
    protected array $required = ['name'];
    protected array $bodyParams = ['name', 'return_path_subdomain', 'custom_tracking_subdomain', 'inbound_routing_subdomain'];
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Domain name to add.'],
        'return_path_subdomain' => ['type' => 'string', 'description' => 'Optional return-path subdomain.'],
        'custom_tracking_subdomain' => ['type' => 'string', 'description' => 'Optional tracking subdomain.'],
        'inbound_routing_subdomain' => ['type' => 'string', 'description' => 'Optional inbound routing subdomain.'],
    ];
}
