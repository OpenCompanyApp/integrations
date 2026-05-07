<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Update an Insightly event.
 */
class InsightlyUpdateEvent extends InsightlyCreateEvent
{
    protected string $toolName = 'insightly_update_event';
    protected string $toolDescription = 'Update an Insightly event.';
    protected string $method = 'PUT';
    protected string $path = '/v3.1/Events';
    protected array $required = ['id'];
    protected array $bodyParams = ['id' => 'EVENT_ID', 'TITLE', 'LOCATION', 'START_DATE_UTC', 'END_DATE_UTC', 'ALL_DAY', 'DETAILS', 'REMINDER_DATE_UTC', 'OWNER_USER_ID', 'CUSTOMFIELDS'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly event ID.'],
        'TITLE' => ['type' => 'string', 'description' => 'Event title.'],
        'LOCATION' => ['type' => 'string', 'description' => 'Event location.'],
        'START_DATE_UTC' => ['type' => 'string', 'description' => 'Start timestamp in UTC.'],
        'END_DATE_UTC' => ['type' => 'string', 'description' => 'End timestamp in UTC.'],
        'ALL_DAY' => ['type' => 'boolean', 'description' => 'Whether the event is all day.'],
        'DETAILS' => ['type' => 'string', 'description' => 'Event details.'],
        'REMINDER_DATE_UTC' => ['type' => 'string', 'description' => 'Reminder timestamp in UTC.'],
        'OWNER_USER_ID' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'CUSTOMFIELDS' => ['type' => 'array', 'description' => 'Custom field values.'],
    ];
}
