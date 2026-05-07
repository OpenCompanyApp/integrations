<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve supplementary files for a Europe PMC article.
 */
class EuropePmcSupplementaryFiles extends EuropePmcFullTextXml
{
    protected const NAME = 'europe_pmc_supplementary_files';
    protected const DESCRIPTION = 'Retrieve supplementary files for a full-text article where Europe PMC provides them.';
    protected const PATH = '{id}/supplementaryFiles';
}
