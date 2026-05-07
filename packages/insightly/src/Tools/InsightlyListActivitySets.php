<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly activity sets.
 */
class InsightlyListActivitySets extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_activity_sets';
    protected string $toolDescription = 'List Insightly activity sets.';
    protected string $path = '/v3.1/ActivitySets';
}
