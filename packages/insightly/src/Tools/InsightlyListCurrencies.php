<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly currencies.
 */
class InsightlyListCurrencies extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_currencies';
    protected string $toolDescription = 'List Insightly currency reference records.';
    protected string $path = '/v3.1/Currencies';
}
