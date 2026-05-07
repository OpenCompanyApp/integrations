<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Fetch an Insightly lead by ID.
 */
class InsightlyGetLead extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_lead';
    protected string $toolDescription = 'Get an Insightly lead by ID.';
    protected string $path = '/v3.1/Leads/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly lead ID.'],
    ];
}
