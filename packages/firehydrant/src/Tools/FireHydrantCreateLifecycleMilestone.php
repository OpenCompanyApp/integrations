<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a milestone.
 *
 * Maps to the official FireHydrant endpoint post /v1/lifecycles/milestones.
 */
class FireHydrantCreateLifecycleMilestone extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_lifecycle_milestone';
    protected const DESCRIPTION = 'Create a milestone

Official FireHydrant endpoint: POST /v1/lifecycles/milestones

Create a new milestone';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/lifecycles/milestones';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
