<?php

namespace OpenCompany\Integrations\PubMed\Tools;

/**
 * Fetch PubMed records, abstracts, or ID lists with EFetch.
 */
class PubMedFetch extends AbstractPubMedTool
{
    protected const NAME = 'pubmed_fetch';
    protected const DESCRIPTION = 'Fetch full PubMed records, abstracts, MEDLINE text, XML, or UID lists with EFetch using UIDs or History server keys.';
    protected const UTILITY = 'efetch';
    protected const DEFAULTS = ['db' => 'pubmed', 'rettype' => 'abstract', 'retmode' => 'xml'];
    protected const REQUIRE_IDS_OR_HISTORY = true;
    protected const PARAMETERS = [
        'id' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'One UID or an array of UIDs.', 'items' => ['type' => 'string']],
        'query_key' => ['type' => 'string', 'required' => false, 'description' => 'History server query key from ESearch, EPost, or ELink.'],
        'WebEnv' => ['type' => 'string', 'required' => false, 'description' => 'History server WebEnv token.'],
        'retstart' => ['type' => 'integer', 'required' => false, 'description' => 'History result offset.'],
        'retmax' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum records to return from History.'],
        'rettype' => ['type' => 'string', 'required' => false, 'description' => 'Fetch type such as abstract, medline, uilist, xml, or fasta for other databases.'],
        'retmode' => ['type' => 'string', 'required' => false, 'description' => 'Response mode such as xml or text.'],
    ];
}
