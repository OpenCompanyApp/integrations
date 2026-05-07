<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Fetch an Insightly organization by ID.
 */
class InsightlyGetOrganization extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_organization';
    protected string $toolDescription = 'Get an Insightly organization by ID.';
    protected string $path = '/v3.1/Organisations/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly organization ID.'],
    ];
}
