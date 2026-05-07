<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public service summaries from an ORCID record.
 */
class OrcidServices extends OrcidRecord
{
    protected const NAME = 'orcid_services';
    protected const DESCRIPTION = 'Read public service summaries for an ORCID iD.';
    protected const PATH = '{orcid}/services';
}
