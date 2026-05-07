<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Get an Ashby candidate by ID. */
class AshbyGetCandidate extends AbstractAshbyTool
{
    protected const NAME = 'ashby_get_candidate';
    protected const DESCRIPTION = 'Get a single Ashby candidate by candidate ID.';
    protected const ENDPOINT = '/candidate.info';
    protected const REQUIRED = ['candidateId'];
    protected const BODY_KEYS = ['candidateId'];
    protected const PARAMETERS = [
        'candidateId' => ['type' => 'string', 'required' => true, 'description' => 'Candidate UUID.'],
        'body' => ['type' => 'object', 'description' => 'Raw candidate.info body.'],
    ];
}
