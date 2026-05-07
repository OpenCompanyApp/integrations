<?php

namespace OpenCompany\Integrations\CisaKev\Tools;

/**
 * Retrieve the official CISA KEV license text.
 */
class CisaKevLicense extends AbstractCisaKevTool
{
    protected const NAME = 'cisa_kev_license';
    protected const DESCRIPTION = 'Retrieve the official CISA KEV license text.';
    protected const METHOD = 'license';
}
