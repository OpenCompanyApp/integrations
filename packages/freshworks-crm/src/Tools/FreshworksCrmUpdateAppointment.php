<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Update a Freshworks CRM appointment.
 */
class FreshworksCrmUpdateAppointment extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_update_appointment';
    protected string $toolDescription = 'Update a Freshworks CRM appointment.';
    protected string $method = 'PUT';
    protected string $path = '/api/appointments/{id}';
    protected string $bodyRoot = 'appointment';
    protected array $required = ['id'];
    protected array $bodyParams = ['title', 'description', 'from_date', 'end_date', 'location', 'targetable_id', 'targetable_type', 'owner_id', 'appointment_attendees_attributes'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Appointment ID.'],
        'title' => ['type' => 'string', 'description' => 'Appointment title.'],
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
