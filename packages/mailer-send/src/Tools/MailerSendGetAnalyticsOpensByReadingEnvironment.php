<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Retrieve MailerSend open analytics by reading environment. */
class MailerSendGetAnalyticsOpensByReadingEnvironment extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_get_analytics_opens_by_reading_environment';
    protected string $toolDescription = 'Get MailerSend open analytics grouped by reading environment.';
    protected string $path = '/analytics/ua-type';
    protected array $required = ['date_from', 'date_to'];
    protected array $queryParams = ['domain_id', 'recipient_id', 'date_from', 'date_to', 'tags'];
    protected array $parameters = [
        'date_from' => ['type' => 'integer', 'required' => true, 'description' => 'UTC Unix timestamp start.'],
        'date_to' => ['type' => 'integer', 'required' => true, 'description' => 'UTC Unix timestamp end.'],
        'domain_id' => ['type' => 'string', 'description' => 'Optional domain ID.'],
        'recipient_id' => ['type' => 'array', 'description' => 'Optional recipient IDs.', 'items' => ['type' => 'string']],
        'tags' => ['type' => 'array', 'description' => 'Tags to filter by.', 'items' => ['type' => 'string']],
    ];
}
