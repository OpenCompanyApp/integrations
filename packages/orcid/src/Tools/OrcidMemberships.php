<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public membership summaries from an ORCID record.
 */
class OrcidMemberships extends OrcidRecord
{
    protected const NAME = 'orcid_memberships';
    protected const DESCRIPTION = 'Read public membership summaries for an ORCID iD.';
    protected const PATH = '{orcid}/memberships';
}
