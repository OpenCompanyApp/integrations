<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read a full public ORCID record.
 */
class OrcidRecord extends AbstractOrcidTool
{
    protected const NAME = 'orcid_record';
    protected const DESCRIPTION = 'Read the full public ORCID record summary for an ORCID iD.';
    protected const PATH = '{orcid}/record';
    protected const PATH_PARAMS = ['orcid'];
    protected const REQUIRED = ['orcid'];
    protected const PARAMETERS = [
        'orcid' => ['type' => 'string', 'required' => true, 'description' => 'ORCID iD, such as 0000-0002-1825-0097.'],
    ];
}
