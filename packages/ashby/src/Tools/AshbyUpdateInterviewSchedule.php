<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Update an Ashby interview schedule. */
class AshbyUpdateInterviewSchedule extends AbstractAshbyTool
{
    protected const NAME = 'ashby_update_interview_schedule';
    protected const DESCRIPTION = 'Update an Ashby interview schedule.';
    protected const ENDPOINT = '/interviewSchedule.update';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw interviewSchedule.update body.'],
    ];
}
