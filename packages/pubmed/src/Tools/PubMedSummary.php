<?php

namespace OpenCompany\Integrations\PubMed\Tools;

/**
 * Retrieve PubMed document summaries with ESummary.
 */
class PubMedSummary extends AbstractPubMedTool
{
    protected const NAME = 'pubmed_summary';
    protected const DESCRIPTION = 'Retrieve document summaries with ESummary using explicit UIDs or a query_key/WebEnv pair from the History server.';
    protected const UTILITY = 'esummary';
    protected const DEFAULTS = ['db' => 'pubmed', 'retmode' => 'json'];
    protected const REQUIRE_IDS_OR_HISTORY = true;
    protected const PARAMETERS = [
        'id' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'One UID or an array of UIDs.', 'items' => ['type' => 'string']],
        'query_key' => ['type' => 'string', 'required' => false, 'description' => 'History server query key from ESearch, EPost, or ELink.'],
        'WebEnv' => ['type' => 'string', 'required' => false, 'description' => 'History server WebEnv token.'],
        'retstart' => ['type' => 'integer', 'required' => false, 'description' => 'History result offset.'],
        'retmax' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum summaries to return from History.'],
        'version' => ['type' => 'string', 'required' => false, 'description' => 'ESummary version, such as 2.0.'],
        'retmode' => ['type' => 'string', 'required' => false, 'description' => 'Response mode. Defaults to json.'],
    ];
}
