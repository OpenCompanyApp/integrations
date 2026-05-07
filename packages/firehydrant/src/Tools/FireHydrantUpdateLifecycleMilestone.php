<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a milestone.
 *
 * Maps to the official FireHydrant endpoint patch /v1/lifecycles/milestones/{milestone_id}.
 */
class FireHydrantUpdateLifecycleMilestone extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_lifecycle_milestone';
    protected const DESCRIPTION = 'Update a milestone

Official FireHydrant endpoint: PATCH /v1/lifecycles/milestones/{milestone_id}

Update a milestone';
    protected const PARAMETERS = array (
  'milestone_id' =>
  array (
    'type' => 'string',
    'description' => 'milestone_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/lifecycles/milestones/{milestone_id}';
    protected const PATH_PARAMS = array (
  'milestone_id' => 'milestone_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
