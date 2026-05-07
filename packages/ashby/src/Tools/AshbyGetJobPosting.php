<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Get one Ashby job posting. */
class AshbyGetJobPosting extends AbstractAshbyTool
{
    protected const NAME = 'ashby_get_job_posting';
    protected const DESCRIPTION = 'Get one Ashby job posting by posting ID.';
    protected const ENDPOINT = '/jobPosting.info';
    protected const REQUIRED = ['jobPostingId'];
    protected const BODY_KEYS = ['jobPostingId'];
    protected const PARAMETERS = [
        'jobPostingId' => ['type' => 'string', 'required' => true, 'description' => 'Job posting UUID.'],
    ];
}
