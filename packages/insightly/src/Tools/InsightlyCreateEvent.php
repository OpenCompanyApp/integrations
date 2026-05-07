<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Create an Insightly event.
 */
class InsightlyCreateEvent extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_create_event';
    protected string $toolDescription = 'Create an Insightly event.';
    protected string $method = 'POST';
    protected string $path = '/v3.1/Events';
    protected array $required = ['TITLE', 'START_DATE_UTC', 'END_DATE_UTC'];
    protected array $bodyParams = ['TITLE', 'LOCATION', 'START_DATE_UTC', 'END_DATE_UTC', 'ALL_DAY', 'DETAILS', 'REMINDER_DATE_UTC', 'OWNER_USER_ID', 'CUSTOMFIELDS'];
    protected array $parameters = [
        'TITLE' => ['type' => 'string', 'required' => true, 'description' => 'Event title.'],
        'LOCATION' => ['type' => 'string', 'description' => 'Event location.'],
        'START_DATE_UTC' => ['type' => 'string', 'required' => true, 'description' => 'Start timestamp in UTC.'],
        'END_DATE_UTC' => ['type' => 'string', 'required' => true, 'description' => 'End timestamp in UTC.'],
        'ALL_DAY' => ['type' => 'boolean', 'description' => 'Whether the event is all day.'],
        'DETAILS' => ['type' => 'string', 'description' => 'Event details.'],
        'REMINDER_DATE_UTC' => ['type' => 'string', 'description' => 'Reminder timestamp in UTC.'],
        'OWNER_USER_ID' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'CUSTOMFIELDS' => ['type' => 'array', 'description' => 'Custom field values.'],
    ];
}
