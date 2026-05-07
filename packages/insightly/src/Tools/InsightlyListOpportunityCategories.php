<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly opportunity categories.
 */
class InsightlyListOpportunityCategories extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_opportunity_categories';
    protected string $toolDescription = 'List Insightly opportunity categories.';
    protected string $path = '/v3.1/OpportunityCategories';
}
