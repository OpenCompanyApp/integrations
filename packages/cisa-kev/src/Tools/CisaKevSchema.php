<?php

namespace OpenCompany\Integrations\CisaKev\Tools;

/**
 * Retrieve the official CISA KEV JSON schema.
 */
class CisaKevSchema extends AbstractCisaKevTool
{
    protected const NAME = 'cisa_kev_schema';
    protected const DESCRIPTION = 'Retrieve the official JSON schema for the CISA KEV catalog feed.';
    protected const METHOD = 'schema';
}
