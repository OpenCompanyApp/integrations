<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly project categories.
 */
class InsightlyListProjectCategories extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_project_categories';
    protected string $toolDescription = 'List Insightly project categories.';
    protected string $path = '/v3.1/ProjectCategories';
}
