<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby job postings. */
class AshbyListJobPostings extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_job_postings';
    protected const DESCRIPTION = 'List published job postings. Set listedOnly=true before exposing postings publicly.';
    protected const ENDPOINT = '/jobPosting.list';
    protected const BODY_KEYS = ['listedOnly', 'jobId', 'cursor', 'syncToken', 'limit'];
    protected const PARAMETERS = [
        'listedOnly' => ['type' => 'boolean', 'description' => 'Only return listed public postings.'],
        'jobId' => ['type' => 'string', 'description' => 'Filter by job UUID.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
