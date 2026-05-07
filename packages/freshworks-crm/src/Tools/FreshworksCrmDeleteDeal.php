<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Delete a Freshworks CRM deal.
 */
class FreshworksCrmDeleteDeal extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_delete_deal';
    protected string $toolDescription = 'Delete a Freshworks CRM deal.';
    protected string $method = 'DELETE';
    protected string $path = '/api/deals/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Deal ID to delete.'],
    ];
}
