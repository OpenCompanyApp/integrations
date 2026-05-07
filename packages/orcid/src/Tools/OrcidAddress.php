<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public address/country data from an ORCID record.
 */
class OrcidAddress extends OrcidRecord
{
    protected const NAME = 'orcid_address';
    protected const DESCRIPTION = 'Read public address and country data for an ORCID iD.';
    protected const PATH = '{orcid}/address';
}
