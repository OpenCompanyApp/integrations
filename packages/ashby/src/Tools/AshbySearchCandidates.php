<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Search Ashby candidates by name or email. */
class AshbySearchCandidates extends AbstractAshbyTool
{
    protected const NAME = 'ashby_search_candidates';
    protected const DESCRIPTION = 'Search candidates by email and/or name. Ashby limits candidate.search responses to 100 results.';
    protected const ENDPOINT = '/candidate.search';
    protected const BODY_KEYS = ['email', 'name'];
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'description' => 'Candidate email.'],
        'name' => ['type' => 'string', 'description' => 'Candidate name.'],
        'body' => ['type' => 'object', 'description' => 'Raw candidate.search body.'],
    ];
}
