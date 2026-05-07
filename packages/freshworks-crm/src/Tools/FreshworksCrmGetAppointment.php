<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Fetch a Freshworks CRM appointment.
 */
class FreshworksCrmGetAppointment extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_get_appointment';
    protected string $toolDescription = 'Get a Freshworks CRM appointment by ID.';
    protected string $path = '/api/appointments/{id}';
    protected array $required = ['id'];
    protected array $queryParams = ['include'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Appointment ID.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
