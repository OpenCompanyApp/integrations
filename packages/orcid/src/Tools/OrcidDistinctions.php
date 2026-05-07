<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public distinction summaries from an ORCID record.
 */
class OrcidDistinctions extends OrcidRecord
{
    protected const NAME = 'orcid_distinctions';
    protected const DESCRIPTION = 'Read public distinction summaries for an ORCID iD.';
    protected const PATH = '{orcid}/distinctions';
}
