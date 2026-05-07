<?php

namespace OpenCompany\Integrations\PubMed\Tools;

/**
 * Retrieve related Entrez records or LinkOut URLs with ELink.
 */
class PubMedLink extends AbstractPubMedTool
{
    protected const NAME = 'pubmed_link';
    protected const DESCRIPTION = 'Retrieve related records, neighbor links, or LinkOut URLs with ELink. Defaults dbfrom to pubmed.';
    protected const UTILITY = 'elink';
    protected const DEFAULTS = ['dbfrom' => 'pubmed', 'retmode' => 'json'];
    protected const REQUIRE_IDS_OR_HISTORY = true;
    protected const PARAMETERS = [
        'id' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'One source UID or an array of UIDs.', 'items' => ['type' => 'string']],
        'dbfrom' => ['type' => 'string', 'required' => false, 'description' => 'Source Entrez database. Defaults to pubmed.'],
        'db' => ['type' => 'string', 'required' => false, 'description' => 'Target Entrez database.'],
        'cmd' => ['type' => 'string', 'required' => false, 'description' => 'ELink command such as neighbor, neighbor_history, acheck, llinks, or prlinks.'],
        'linkname' => ['type' => 'string', 'required' => false, 'description' => 'Specific link name to retrieve.'],
        'query_key' => ['type' => 'string', 'required' => false, 'description' => 'History server query key where supported.'],
        'WebEnv' => ['type' => 'string', 'required' => false, 'description' => 'History server WebEnv token.'],
        'retmode' => ['type' => 'string', 'required' => false, 'description' => 'Response mode. Defaults to json.'],
    ];
}
