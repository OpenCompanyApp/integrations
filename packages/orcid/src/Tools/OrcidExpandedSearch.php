<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Search ORCID with expanded identity and affiliation fields.
 */
class OrcidExpandedSearch extends OrcidSearch
{
    protected const NAME = 'orcid_expanded_search';
    protected const DESCRIPTION = 'Search ORCID and return expanded public fields such as names, other names, email when public, and institutions.';
    protected const PATH = 'expanded-search';
}
