<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Create a Freshworks CRM appointment.
 */
class FreshworksCrmCreateAppointment extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_create_appointment';
    protected string $toolDescription = 'Create a Freshworks CRM appointment.';
    protected string $method = 'POST';
    protected string $path = '/api/appointments';
    protected string $bodyRoot = 'appointment';
    protected array $required = ['title'];
    protected array $bodyParams = ['title', 'description', 'from_date', 'end_date', 'location', 'targetable_id', 'targetable_type', 'owner_id', 'appointment_attendees_attributes'];
    protected array $parameters = [
        'title' => ['type' => 'string', 'required' => true, 'description' => 'Appointment title.'],
        'description' => ['type' => 'string', 'description' => 'Appointment description.'],
        'from_date' => ['type' => 'string', 'description' => 'Start date/time string.'],
        'end_date' => ['type' => 'string', 'description' => 'End date/time string.'],
        'location' => ['type' => 'string', 'description' => 'Location.'],
        'targetable_id' => ['type' => 'integer', 'description' => 'Related record ID.'],
        'targetable_type' => ['type' => 'string', 'description' => 'Related record type.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'appointment_attendees_attributes' => ['type' => 'array', 'description' => 'Attendee attributes.'],
    ];
}
