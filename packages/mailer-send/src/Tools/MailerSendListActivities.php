<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** List activity events for a MailerSend domain. */
class MailerSendListActivities extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_list_activities';
    protected string $toolDescription = 'List MailerSend activity events for a domain.';
    protected string $path = '/activity/{domain_id}';
    protected array $required = ['domain_id', 'date_from', 'date_to'];
    protected array $queryParams = ['page', 'limit', 'date_from', 'date_to', 'event'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'required' => true, 'description' => 'MailerSend domain ID.'],
        'date_from' => ['type' => 'integer', 'required' => true, 'description' => 'UTC Unix timestamp start.'],
        'date_to' => ['type' => 'integer', 'required' => true, 'description' => 'UTC Unix timestamp end.'],
        'event' => ['type' => 'array', 'description' => 'Activity event filters.', 'items' => ['type' => 'string']],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'limit' => ['type' => 'integer', 'description' => 'Page size, usually 10 to 100.'],
    ];
}
