<?php

namespace OpenCompany\Integrations\CisaKev\Tools;

/**
 * Retrieve the official CISA KEV CSV export.
 */
class CisaKevCsv extends AbstractCisaKevTool
{
    protected const NAME = 'cisa_kev_csv';
    protected const DESCRIPTION = 'Retrieve the official CISA KEV CSV export as text.';
    protected const METHOD = 'csv';
}
