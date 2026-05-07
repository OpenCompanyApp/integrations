<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get one Insightly activity set.
 */
class InsightlyGetActivitySet extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_activity_set';
    protected string $toolDescription = 'Get an Insightly activity set by ID.';
    protected string $path = '/v3.1/ActivitySets/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly activity set ID.'],
    ];
}
