<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List notes for an Ashby candidate. */
class AshbyListCandidateNotes extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_candidate_notes';
    protected const DESCRIPTION = 'List notes on a candidate in Ashby.';
    protected const ENDPOINT = '/candidate.listNotes';
    protected const REQUIRED = ['candidateId'];
    protected const BODY_KEYS = ['candidateId', 'cursor', 'syncToken', 'limit'];
    protected const PARAMETERS = [
        'candidateId' => ['type' => 'string', 'required' => true, 'description' => 'Candidate UUID.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
