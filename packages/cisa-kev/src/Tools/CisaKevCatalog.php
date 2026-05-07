<?php

namespace OpenCompany\Integrations\CisaKev\Tools;

/**
 * Retrieve the full official CISA KEV JSON catalog.
 */
class CisaKevCatalog extends AbstractCisaKevTool
{
    protected const NAME = 'cisa_kev_catalog';
    protected const DESCRIPTION = 'Retrieve the full official CISA Known Exploited Vulnerabilities JSON catalog.';
    protected const METHOD = 'catalog';
}
