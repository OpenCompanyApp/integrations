<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM appointments.
 */
class FreshworksCrmListAppointments extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_appointments';
    protected string $toolDescription = 'List Freshworks CRM appointments.';
    protected string $path = '/api/appointments';
    protected array $queryParams = ['filter', 'page', 'per_page', 'include'];
    protected array $parameters = [
        'filter' => ['type' => 'string', 'description' => 'Appointment filter name.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
