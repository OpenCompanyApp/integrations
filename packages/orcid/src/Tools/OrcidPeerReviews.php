<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Read public peer-review summaries from an ORCID record.
 */
class OrcidPeerReviews extends OrcidRecord
{
    protected const NAME = 'orcid_peer_reviews';
    protected const DESCRIPTION = 'Read public peer-review summaries for an ORCID iD.';
    protected const PATH = '{orcid}/peer-reviews';
}
