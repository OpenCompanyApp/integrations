<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly lead statuses.
 */
class InsightlyListLeadStatuses extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_lead_statuses';
    protected string $toolDescription = 'List Insightly lead statuses.';
    protected string $path = '/v3.1/LeadStatuses';
}
