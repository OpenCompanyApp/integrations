<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public other names from an ORCID record.
 */
class OrcidOtherNames extends OrcidRecord
{
    protected const NAME = 'orcid_other_names';
    protected const DESCRIPTION = 'Read public other names for an ORCID iD.';
    protected const PATH = '{orcid}/other-names';
}
