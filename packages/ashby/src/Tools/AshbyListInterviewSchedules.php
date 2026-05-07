<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby interview schedules. */
class AshbyListInterviewSchedules extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_interview_schedules';
    protected const DESCRIPTION = 'List interview schedules, optionally filtered by application or stage.';
    protected const ENDPOINT = '/interviewSchedule.list';
    protected const BODY_KEYS = ['createdAfter', 'cursor', 'syncToken', 'limit', 'applicationId', 'interviewStageId'];
    protected const PARAMETERS = [
        'applicationId' => ['type' => 'string', 'description' => 'Application UUID.'],
        'interviewStageId' => ['type' => 'string', 'description' => 'Interview stage UUID.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
