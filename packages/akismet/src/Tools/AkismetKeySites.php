<?php

namespace OpenCompany\Integrations\Akismet\Tools;

/**
 * Retrieve site activity for the API key.
 */
class AkismetKeySites extends AbstractAkismetTool
{
    protected const NAME = 'akismet_key_sites';
    protected const DESCRIPTION = 'Retrieve Akismet API-key site activity by month, optionally as JSON or CSV.';
    protected const METHOD = 'keySites';
    protected const PARAMETERS = [
        'month' => ['type' => 'string', 'required' => false, 'description' => 'Month to report, formatted as YYYY-MM. Defaults to current month.'],
        'filter' => ['type' => 'string', 'required' => false, 'description' => 'Filter results by site URL or partial site URL.'],
        'format' => ['type' => 'string', 'required' => false, 'description' => 'Response format.', 'enum' => ['json', 'csv']],
        'order' => ['type' => 'string', 'required' => false, 'description' => 'Sort column.', 'enum' => ['total', 'spam', 'ham', 'missed_spam', 'false_positives']],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results. Defaults to 500.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Result offset. Defaults to 0.'],
    ];
}
