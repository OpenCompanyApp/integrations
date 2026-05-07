<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly countries.
 */
class InsightlyListCountries extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_countries';
    protected string $toolDescription = 'List Insightly country reference records.';
    protected string $path = '/v3.1/Countries';
}
