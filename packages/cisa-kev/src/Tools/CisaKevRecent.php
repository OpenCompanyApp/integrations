<?php

namespace OpenCompany\Integrations\CisaKev\Tools;

/**
 * List recently added KEV catalog entries.
 */
class CisaKevRecent extends AbstractCisaKevTool
{
    protected const NAME = 'cisa_kev_recent';
    protected const DESCRIPTION = 'List recently added CISA KEV catalog entries, sorted by dateAdded descending.';
    protected const METHOD = 'recent';
    protected const PARAMETERS = [
        'since' => ['type' => 'string', 'required' => false, 'description' => 'Minimum dateAdded in YYYY-MM-DD format.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
    ];
}
