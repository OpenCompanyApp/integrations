<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Create an Ashby application for a candidate and job. */
class AshbyCreateApplication extends AbstractAshbyTool
{
    protected const NAME = 'ashby_create_application';
    protected const DESCRIPTION = 'Consider a candidate for a job by creating an Ashby application.';
    protected const ENDPOINT = '/application.create';
    protected const REQUIRED = ['candidateId', 'jobId'];
    protected const BODY_KEYS = ['candidateId', 'jobId', 'interviewPlanId', 'interviewStageId', 'sourceId', 'creditedToUserId', 'createdAt', 'applicationHistory'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'candidateId' => ['type' => 'string', 'required' => true, 'description' => 'Candidate UUID.'],
        'jobId' => ['type' => 'string', 'required' => true, 'description' => 'Job UUID.'],
        'interviewPlanId' => ['type' => 'string', 'description' => 'Interview plan UUID.'],
        'interviewStageId' => ['type' => 'string', 'description' => 'Interview stage UUID or supported special value.'],
        'body' => ['type' => 'object', 'description' => 'Raw application.create body.'],
    ];
}
