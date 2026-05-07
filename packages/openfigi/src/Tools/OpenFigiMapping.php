<?php

namespace OpenCompany\Integrations\OpenFigi\Tools;

/**
 * Map third-party identifiers to FIGIs.
 */
class OpenFigiMapping extends AbstractOpenFigiTool
{
    protected const NAME = 'openfigi_mapping';
    protected const DESCRIPTION = 'Map third-party identifiers such as ticker, ISIN, CUSIP, SEDOL, and Bloomberg identifiers to FIGIs.';
    protected const METHOD = 'mapping';
    protected const REQUIRED = ['jobs'];
    protected const PARAMETERS = [
        'jobs' => ['type' => 'array', 'required' => true, 'description' => 'OpenFIGI mapping jobs. Each job must include idType and idValue.', 'items' => ['type' => 'object']],
    ];
}
