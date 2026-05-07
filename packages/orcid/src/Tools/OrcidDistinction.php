<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public distinction from an ORCID record.
 */
class OrcidDistinction extends OrcidWork
{
    protected const NAME = 'orcid_distinction';
    protected const DESCRIPTION = 'Read one public ORCID distinction by put code.';
    protected const PATH = '{orcid}/distinction/{put_code}';
}
