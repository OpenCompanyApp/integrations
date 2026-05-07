<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Update an Ashby candidate. */
class AshbyUpdateCandidate extends AbstractAshbyTool
{
    protected const NAME = 'ashby_update_candidate';
    protected const DESCRIPTION = 'Update an existing candidate in Ashby.';
    protected const ENDPOINT = '/candidate.update';
    protected const REQUIRED = ['candidateId'];
    protected const BODY_KEYS = ['candidateId', 'name', 'email', 'phoneNumber', 'linkedInUrl', 'githubUrl', 'website', 'location', 'sourceId'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'candidateId' => ['type' => 'string', 'required' => true, 'description' => 'Candidate UUID.'],
        'name' => ['type' => 'string', 'description' => 'Candidate name.'],
        'email' => ['type' => 'string', 'description' => 'Candidate email.'],
        'body' => ['type' => 'object', 'description' => 'Raw candidate.update body.'],
    ];
}
