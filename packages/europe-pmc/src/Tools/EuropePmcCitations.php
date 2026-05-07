<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * List citations for a Europe PMC article.
 */
class EuropePmcCitations extends EuropePmcReferences
{
    protected const NAME = 'europe_pmc_citations';
    protected const DESCRIPTION = 'Retrieve a count and list of publications that cite a Europe PMC article.';
    protected const PATH = '{source}/{id}/citations';
}
