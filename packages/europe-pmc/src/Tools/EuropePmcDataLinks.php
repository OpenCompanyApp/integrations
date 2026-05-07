<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve consolidated data-literature links in Scholix format.
 */
class EuropePmcDataLinks extends EuropePmcReferences
{
    protected const NAME = 'europe_pmc_data_links';
    protected const DESCRIPTION = 'Retrieve consolidated data-literature links for an article in Scholix-oriented output.';
    protected const PATH = '{source}/{id}/datalinks';
}
