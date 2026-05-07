<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Bulk upsert Freshworks CRM deals.
 */
class FreshworksCrmBulkUpsertDeals extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_bulk_upsert_deals';
    protected string $toolDescription = 'Bulk upsert Freshworks CRM deals.';
    protected string $method = 'POST';
    protected string $path = '/api/deals/bulk_upsert';
    protected array $required = ['deals'];
    protected array $bodyParams = ['deals', 'unique_identifier'];
    protected array $parameters = [
        'deals' => ['type' => 'array', 'required' => true, 'description' => 'Deal payloads.'],
        'unique_identifier' => ['type' => 'string', 'description' => 'Unique identifier field.'],
    ];
}
