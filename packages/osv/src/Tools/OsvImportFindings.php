<?php

namespace OpenCompany\Integrations\Osv\Tools;

/**
 * Retrieve experimental import-quality findings for an OSV source.
 */
class OsvImportFindings extends AbstractOsvTool
{
    protected const NAME = 'osv_import_findings';
    protected const DESCRIPTION = 'Retrieve experimental OSV import-time quality findings for a source name.';
    protected const METHOD = 'importFindings';
    protected const REQUIRED = ['source'];
    protected const PARAMETERS = [
        'source' => ['type' => 'string', 'required' => true, 'description' => 'Case-sensitive OSV source name, such as ghsa.'],
    ];
}
