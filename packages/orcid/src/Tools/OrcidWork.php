<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public work from an ORCID record.
 */
class OrcidWork extends OrcidRecord
{
    protected const NAME = 'orcid_work';
    protected const DESCRIPTION = 'Read one public ORCID work by put code.';
    protected const PATH = '{orcid}/work/{put_code}';
    protected const PATH_PARAMS = ['orcid', 'put_code'];
    protected const REQUIRED = ['orcid', 'put_code'];
    protected const PARAMETERS = [
        'orcid' => ['type' => 'string', 'required' => true, 'description' => 'ORCID iD.'],
        'put_code' => ['type' => 'integer', 'required' => true, 'description' => 'ORCID put code for the work.'],
    ];
}
