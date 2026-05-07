<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Create an Ashby candidate. */
class AshbyCreateCandidate extends AbstractAshbyTool
{
    protected const NAME = 'ashby_create_candidate';
    protected const DESCRIPTION = 'Create a new candidate in Ashby.';
    protected const ENDPOINT = '/candidate.create';
    protected const BODY_KEYS = ['name', 'email', 'phoneNumber', 'linkedInUrl', 'githubUrl', 'website', 'location', 'sourceId'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'description' => 'Candidate name.'],
        'email' => ['type' => 'string', 'description' => 'Candidate email.'],
        'phoneNumber' => ['type' => 'string', 'description' => 'Candidate phone number.'],
        'sourceId' => ['type' => 'string', 'description' => 'Candidate source UUID.'],
        'body' => ['type' => 'object', 'description' => 'Raw candidate.create body.'],
    ];
}
