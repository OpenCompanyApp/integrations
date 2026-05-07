<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public education from an ORCID record.
 */
class OrcidEducation extends OrcidWork
{
    protected const NAME = 'orcid_education';
    protected const DESCRIPTION = 'Read one public ORCID education by put code.';
    protected const PATH = '{orcid}/education/{put_code}';
}
