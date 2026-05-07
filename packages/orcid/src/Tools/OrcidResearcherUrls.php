<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public researcher URLs from an ORCID record.
 */
class OrcidResearcherUrls extends OrcidRecord
{
    protected const NAME = 'orcid_researcher_urls';
    protected const DESCRIPTION = 'Read public researcher URLs for an ORCID iD.';
    protected const PATH = '{orcid}/researcher-urls';
}
