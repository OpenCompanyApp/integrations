<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve biological database cross-references for an article.
 */
class EuropePmcDatabaseLinks extends EuropePmcReferences
{
    protected const NAME = 'europe_pmc_database_links';
    protected const DESCRIPTION = 'Retrieve biological database cross-references that cite or are linked to a Europe PMC article.';
    protected const PATH = '{source}/{id}/databaseLinks';
}
