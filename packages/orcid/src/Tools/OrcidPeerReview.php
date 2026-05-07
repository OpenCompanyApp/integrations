<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read one public peer review from an ORCID record.
 */
class OrcidPeerReview extends OrcidWork
{
    protected const NAME = 'orcid_peer_review';
    protected const DESCRIPTION = 'Read one public ORCID peer review by put code.';
    protected const PATH = '{orcid}/peer-review/{put_code}';
}
