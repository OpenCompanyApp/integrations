<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public funding summaries from an ORCID record.
 */
class OrcidFundings extends OrcidRecord
{
    protected const NAME = 'orcid_fundings';
    protected const DESCRIPTION = 'Read public funding summaries for an ORCID iD.';
    protected const PATH = '{orcid}/fundings';
}
