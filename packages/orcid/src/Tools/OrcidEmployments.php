<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public employment summaries from an ORCID record.
 */
class OrcidEmployments extends OrcidRecord
{
    protected const NAME = 'orcid_employments';
    protected const DESCRIPTION = 'Read public employment summaries for an ORCID iD.';
    protected const PATH = '{orcid}/employments';
}
