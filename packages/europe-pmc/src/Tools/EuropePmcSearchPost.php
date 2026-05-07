<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Search Europe PMC publication metadata with POST /searchPOST.
 */
class EuropePmcSearchPost extends EuropePmcSearch
{
    protected const NAME = 'europe_pmc_search_post';
    protected const DESCRIPTION = 'Search Europe PMC publications with POST /searchPOST for long query strings.';
    protected const METHOD = 'POST';
    protected const PATH = 'searchPOST';
}
