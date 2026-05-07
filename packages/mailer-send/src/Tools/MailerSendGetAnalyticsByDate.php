<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve MailerSend analytics grouped by date. */
class MailerSendGetAnalyticsByDate extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_analytics_by_date';
    protected string $toolDescription = 'Get MailerSend activity analytics grouped by date.';
    protected string $path = '/analytics/date';
    protected array $required = ['date_from', 'date_to', 'event'];
    protected array $queryParams = ['domain_id', 'recipient_id', 'date_from', 'date_to', 'group_by', 'tags', 'event'];
    protected array $parameters = [
        'date_from' => ['type' => 'integer', 'required' => true, 'description' => 'UTC Unix timestamp start.'],
        'date_to' => ['type' => 'integer', 'required' => true, 'description' => 'UTC Unix timestamp end.'],
        'event' => ['type' => 'array', 'required' => true, 'description' => 'Events to include.', 'items' => ['type' => 'string']],
        'domain_id' => ['type' => 'string', 'description' => 'Optional domain ID.'],
        'recipient_id' => ['type' => 'array', 'description' => 'Optional recipient IDs.', 'items' => ['type' => 'string']],
        'group_by' => ['type' => 'string', 'description' => 'days, weeks, months, or years.'],
        'tags' => ['type' => 'array', 'description' => 'Tags to filter by.', 'items' => ['type' => 'string']],
    ];
}
