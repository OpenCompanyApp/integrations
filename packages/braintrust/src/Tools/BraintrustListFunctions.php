<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust functions, tools, and scorers.
 */
class BraintrustListFunctions extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_functions';
    protected const DESCRIPTION = 'List Braintrust functions, including prompts, tools, and scorers. Pass filters in query.';
    protected const PATH = '/v1/function';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters such as project_id, slug, function_type, limit, or cursor.']];
}
