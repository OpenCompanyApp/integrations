<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Run a Freshworks CRM lookup query.
 */
class FreshworksCrmLookup extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_lookup';
    protected string $toolDescription = 'Run a Freshworks CRM lookup query.';
    protected string $path = '/api/lookup';
    protected array $required = ['q'];
    protected array $queryParams = ['q', 'include'];
    protected array $parameters = [
        'q' => ['type' => 'string', 'required' => true, 'description' => 'Lookup query.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
