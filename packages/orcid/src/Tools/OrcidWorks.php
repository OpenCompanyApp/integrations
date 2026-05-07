<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public works summary groups from an ORCID record.
 */
class OrcidWorks extends OrcidRecord
{
    protected const NAME = 'orcid_works';
    protected const DESCRIPTION = 'Read public works summary groups for an ORCID iD.';
    protected const PATH = '{orcid}/works';
}
