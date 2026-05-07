<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public keywords from an ORCID record.
 */
class OrcidKeywords extends OrcidRecord
{
    protected const NAME = 'orcid_keywords';
    protected const DESCRIPTION = 'Read public keywords for an ORCID iD.';
    protected const PATH = '{orcid}/keywords';
}
