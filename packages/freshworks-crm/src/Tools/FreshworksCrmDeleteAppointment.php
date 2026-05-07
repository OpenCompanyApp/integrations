<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Delete a Freshworks CRM appointment.
 */
class FreshworksCrmDeleteAppointment extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_delete_appointment';
    protected string $toolDescription = 'Delete a Freshworks CRM appointment.';
    protected string $method = 'DELETE';
    protected string $path = '/api/appointments/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Appointment ID to delete.'],
    ];
}
