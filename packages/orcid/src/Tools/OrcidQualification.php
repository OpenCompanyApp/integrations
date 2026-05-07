<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public qualification from an ORCID record.
 */
class OrcidQualification extends OrcidWork
{
    protected const NAME = 'orcid_qualification';
    protected const DESCRIPTION = 'Read one public ORCID qualification by put code.';
    protected const PATH = '{orcid}/qualification/{put_code}';
}
