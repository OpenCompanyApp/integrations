<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust project score definitions.
 */
class BraintrustListProjectScores extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_project_scores';
    protected const DESCRIPTION = 'List Braintrust project score definitions.';
    protected const PATH = '/v1/project_score';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters and pagination.']];
}
