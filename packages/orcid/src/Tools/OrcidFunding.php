<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public funding from an ORCID record.
 */
class OrcidFunding extends OrcidWork
{
    protected const NAME = 'orcid_funding';
    protected const DESCRIPTION = 'Read one public ORCID funding by put code.';
    protected const PATH = '{orcid}/funding/{put_code}';
}
