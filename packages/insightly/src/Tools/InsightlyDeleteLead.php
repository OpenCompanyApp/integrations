<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly lead.
 */
class InsightlyDeleteLead extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_lead';
    protected string $toolDescription = 'Delete an Insightly lead.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Leads/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly lead ID to delete.'],
    ];
}
