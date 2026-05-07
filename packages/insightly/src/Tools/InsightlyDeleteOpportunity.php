<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly opportunity.
 */
class InsightlyDeleteOpportunity extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_opportunity';
    protected string $toolDescription = 'Delete an Insightly opportunity.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Opportunities/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly opportunity ID to delete.'],
    ];
}
