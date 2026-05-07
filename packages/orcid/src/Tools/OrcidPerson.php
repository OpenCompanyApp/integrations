<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read the public person section of an ORCID record.
 */
class OrcidPerson extends OrcidRecord
{
    protected const NAME = 'orcid_person';
    protected const DESCRIPTION = 'Read the public person section of an ORCID record.';
    protected const PATH = '{orcid}/person';
}
