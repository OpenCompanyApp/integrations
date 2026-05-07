<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Run Freshworks CRM filtered contact search.
 */
class FreshworksCrmFilteredSearchContact extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_filtered_search_contact';
    protected string $toolDescription = 'Run a Freshworks CRM filtered contact search.';
    protected string $method = 'POST';
    protected string $path = '/api/filtered_search/contact';
    protected array $bodyParams = ['filter_rule', 'page', 'per_page'];
    protected array $parameters = [
        'filter_rule' => ['type' => 'object', 'description' => 'Freshworks CRM filter rule object.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
    ];
}
