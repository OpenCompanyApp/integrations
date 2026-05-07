<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public invited-position summaries from an ORCID record.
 */
class OrcidInvitedPositions extends OrcidRecord
{
    protected const NAME = 'orcid_invited_positions';
    protected const DESCRIPTION = 'Read public invited-position summaries for an ORCID iD.';
    protected const PATH = '{orcid}/invited-positions';
}
