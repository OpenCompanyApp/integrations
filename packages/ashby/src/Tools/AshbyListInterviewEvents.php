<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List interview events for an Ashby interview schedule. */
class AshbyListInterviewEvents extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_interview_events';
    protected const DESCRIPTION = 'List interview events associated with an interview schedule.';
    protected const ENDPOINT = '/interviewEvent.list';
    protected const REQUIRED = ['interviewScheduleId'];
    protected const BODY_KEYS = ['createdAfter', 'cursor', 'syncToken', 'limit', 'interviewScheduleId', 'expand'];
    protected const PARAMETERS = [
        'interviewScheduleId' => ['type' => 'string', 'required' => true, 'description' => 'Interview schedule UUID.'],
        'expand' => ['type' => 'array', 'description' => 'Related objects to expand.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
