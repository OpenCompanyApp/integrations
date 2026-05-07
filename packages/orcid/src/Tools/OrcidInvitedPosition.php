<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public invited position from an ORCID record.
 */
class OrcidInvitedPosition extends OrcidWork
{
    protected const NAME = 'orcid_invited_position';
    protected const DESCRIPTION = 'Read one public ORCID invited position by put code.';
    protected const PATH = '{orcid}/invited-position/{put_code}';
}
