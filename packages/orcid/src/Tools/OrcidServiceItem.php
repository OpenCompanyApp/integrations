<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public service from an ORCID record.
 */
class OrcidServiceItem extends OrcidWork
{
    protected const NAME = 'orcid_service';
    protected const DESCRIPTION = 'Read one public ORCID service by put code.';
    protected const PATH = '{orcid}/service/{put_code}';
}
