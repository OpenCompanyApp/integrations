<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Create an Ashby job. */
class AshbyCreateJob extends AbstractAshbyTool
{
    protected const NAME = 'ashby_create_job';
    protected const DESCRIPTION = 'Create a new Ashby job.';
    protected const ENDPOINT = '/job.create';
    protected const REQUIRED = ['title', 'teamId', 'locationId'];
    protected const BODY_KEYS = ['title', 'teamId', 'locationId', 'defaultInterviewPlanId', 'jobTemplateId', 'brandId'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'title' => ['type' => 'string', 'required' => true, 'description' => 'Job title.'],
        'teamId' => ['type' => 'string', 'required' => true, 'description' => 'Department/team UUID.'],
        'locationId' => ['type' => 'string', 'required' => true, 'description' => 'Location UUID.'],
        'body' => ['type' => 'object', 'description' => 'Raw job.create body.'],
    ];
}
