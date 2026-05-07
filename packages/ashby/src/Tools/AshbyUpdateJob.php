<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Update an Ashby job. */
class AshbyUpdateJob extends AbstractAshbyTool
{
    protected const NAME = 'ashby_update_job';
    protected const DESCRIPTION = 'Update an existing Ashby job.';
    protected const ENDPOINT = '/job.update';
    protected const REQUIRED = ['jobId'];
    protected const BODY_KEYS = ['jobId', 'title', 'teamId', 'locationId', 'defaultInterviewPlanId', 'brandId'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'jobId' => ['type' => 'string', 'required' => true, 'description' => 'Job UUID.'],
        'title' => ['type' => 'string', 'description' => 'Job title.'],
        'body' => ['type' => 'object', 'description' => 'Raw job.update body.'],
    ];
}
