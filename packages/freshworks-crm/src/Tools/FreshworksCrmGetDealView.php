<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Fetch deals from a Freshworks CRM view.
 */
class FreshworksCrmGetDealView extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_get_deal_view';
    protected string $toolDescription = 'Fetch deals from a Freshworks CRM view.';
    protected string $path = '/api/deals/view/{view_id}';
    protected array $required = ['view_id'];
    protected array $queryParams = ['page', 'per_page', 'include'];
    protected array $parameters = [
        'view_id' => ['type' => 'integer', 'required' => true, 'description' => 'Deal view ID.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
