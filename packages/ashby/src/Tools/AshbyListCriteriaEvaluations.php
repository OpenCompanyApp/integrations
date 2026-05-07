<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List AI criteria evaluations for an Ashby application. */
class AshbyListCriteriaEvaluations extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_criteria_evaluations';
    protected const DESCRIPTION = 'List AI-generated criteria evaluations for an Ashby application when available.';
    protected const ENDPOINT = '/application.listCriteriaEvaluations';
    protected const REQUIRED = ['applicationId'];
    protected const BODY_KEYS = ['applicationId'];
    protected const PARAMETERS = [
        'applicationId' => ['type' => 'string', 'required' => true, 'description' => 'Application UUID.'],
    ];
}
