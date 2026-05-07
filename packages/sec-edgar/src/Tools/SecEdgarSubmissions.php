<?php

namespace OpenCompany\Integrations\SecEdgar\Tools;

/**
 * Retrieve current SEC EDGAR submissions history for a filer.
 */
class SecEdgarSubmissions extends AbstractSecEdgarTool
{
    protected const NAME = 'sec_edgar_submissions';
    protected const DESCRIPTION = 'Retrieve current SEC EDGAR filing history and filer metadata by CIK.';
    protected const METHOD = 'submissions';
    protected const REQUIRED = ['cik'];
    protected const PARAMETERS = [
        'cik' => ['type' => ['string', 'integer'], 'required' => true, 'description' => 'Central Index Key. Leading zeros are optional.'],
    ];
}
