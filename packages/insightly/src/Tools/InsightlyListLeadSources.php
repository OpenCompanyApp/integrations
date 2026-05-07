<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly lead sources.
 */
class InsightlyListLeadSources extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_lead_sources';
    protected string $toolDescription = 'List Insightly lead sources.';
    protected string $path = '/v3.1/LeadSources';
}
