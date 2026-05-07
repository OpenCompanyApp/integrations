<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public personal details from an ORCID record.
 */
class OrcidPersonalDetails extends OrcidRecord
{
    protected const NAME = 'orcid_personal_details';
    protected const DESCRIPTION = 'Read public personal details for an ORCID iD.';
    protected const PATH = '{orcid}/personal-details';
}
