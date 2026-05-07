<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public qualification summaries from an ORCID record.
 */
class OrcidQualifications extends OrcidRecord
{
    protected const NAME = 'orcid_qualifications';
    protected const DESCRIPTION = 'Read public qualification summaries for an ORCID iD.';
    protected const PATH = '{orcid}/qualifications';
}
