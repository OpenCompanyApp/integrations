<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly organization.
 */
class InsightlyDeleteOrganization extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_organization';
    protected string $toolDescription = 'Delete an Insightly organization.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Organisations/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly organization ID to delete.'],
    ];
}
