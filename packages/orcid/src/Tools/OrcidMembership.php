<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public membership from an ORCID record.
 */
class OrcidMembership extends OrcidWork
{
    protected const NAME = 'orcid_membership';
    protected const DESCRIPTION = 'Read one public ORCID membership by put code.';
    protected const PATH = '{orcid}/membership/{put_code}';
}
