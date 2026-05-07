<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Search Freshworks CRM records globally.
 */
class FreshworksCrmSearch extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_search';
    protected string $toolDescription = 'Run a Freshworks CRM global search query.';
    protected string $path = '/api/search';
    protected array $required = ['q'];
    protected array $queryParams = ['q', 'include'];
    protected array $parameters = [
        'q' => ['type' => 'string', 'required' => true, 'description' => 'Search query.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
