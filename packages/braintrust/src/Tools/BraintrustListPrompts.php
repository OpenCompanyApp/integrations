<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust prompts.
 */
class BraintrustListPrompts extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_prompts';
    protected const DESCRIPTION = 'List Braintrust prompts. Pass filters and pagination in query.';
    protected const PATH = '/v1/prompt';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters such as project_id, slug, name, version, limit, or cursor.']];
}
