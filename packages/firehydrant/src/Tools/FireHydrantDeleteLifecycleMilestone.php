<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a milestone.
 *
 * Maps to the official FireHydrant endpoint delete /v1/lifecycles/milestones/{milestone_id}.
 */
class FireHydrantDeleteLifecycleMilestone extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_lifecycle_milestone';
    protected const DESCRIPTION = 'Delete a milestone

Official FireHydrant endpoint: DELETE /v1/lifecycles/milestones/{milestone_id}

Delete a milestone';
    protected const PARAMETERS = array (
  'milestone_id' =>
  array (
    'type' => 'string',
    'description' => 'milestone_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
