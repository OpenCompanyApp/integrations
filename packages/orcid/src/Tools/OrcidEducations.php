<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public education summaries from an ORCID record.
 */
class OrcidEducations extends OrcidRecord
{
    protected const NAME = 'orcid_educations';
    protected const DESCRIPTION = 'Read public education summaries for an ORCID iD.';
    protected const PATH = '{orcid}/educations';
}
