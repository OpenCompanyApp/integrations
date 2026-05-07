<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read the public activities summary for an ORCID record.
 */
class OrcidActivities extends OrcidRecord
{
    protected const NAME = 'orcid_activities';
    protected const DESCRIPTION = 'Read the public activities summary for an ORCID iD.';
    protected const PATH = '{orcid}/activities';
}
