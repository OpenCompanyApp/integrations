<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby interview plans. */
class AshbyListInterviewPlans extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_interview_plans';
    protected const DESCRIPTION = 'List Ashby interview plans.';
    protected const ENDPOINT = '/interviewPlan.list';
    protected const BODY_KEYS = ['includeArchived', 'cursor', 'syncToken', 'limit'];
    protected const PARAMETERS = [
        'includeArchived' => ['type' => 'boolean', 'description' => 'Include archived plans.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
