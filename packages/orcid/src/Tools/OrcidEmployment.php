<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public employment from an ORCID record.
 */
class OrcidEmployment extends OrcidWork
{
    protected const NAME = 'orcid_employment';
    protected const DESCRIPTION = 'Read one public ORCID employment by put code.';
    protected const PATH = '{orcid}/employment/{put_code}';
}
