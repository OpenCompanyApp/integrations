<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public external identifiers from an ORCID record.
 */
class OrcidExternalIdentifiers extends OrcidRecord
{
    protected const NAME = 'orcid_external_identifiers';
    protected const DESCRIPTION = 'Read public external identifiers for an ORCID iD.';
    protected const PATH = '{orcid}/external-identifiers';
}
