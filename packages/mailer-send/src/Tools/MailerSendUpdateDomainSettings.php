<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Update MailerSend domain settings. */
class MailerSendUpdateDomainSettings extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_update_domain_settings';
    protected string $toolDescription = 'Update sending domain settings such as tracking and custom return path.';
    protected string $method = 'PUT';
    protected string $path = '/domains/{domain_id}/settings';
    protected array $required = ['domain_id'];
    protected array $bodyParams = ['send_paused', 'track_clicks', 'track_opens', 'track_unsubscribe', 'track_content', 'custom_tracking_enabled', 'custom_tracking_subdomain', 'return_path_subdomain'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'],
        'send_paused' => ['type' => 'boolean', 'description' => 'Pause sending from this domain.'],
        'track_clicks' => ['type' => 'boolean', 'description' => 'Track clicks.'],
        'track_opens' => ['type' => 'boolean', 'description' => 'Track opens.'],
        'track_unsubscribe' => ['type' => 'boolean', 'description' => 'Track unsubscribes.'],
        'track_content' => ['type' => 'boolean', 'description' => 'Track content.'],
        'custom_tracking_enabled' => ['type' => 'boolean', 'description' => 'Enable custom tracking.'],
        'custom_tracking_subdomain' => ['type' => 'string', 'description' => 'Custom tracking subdomain.'],
        'return_path_subdomain' => ['type' => 'string', 'description' => 'Return-path subdomain.'],
    ];
}
