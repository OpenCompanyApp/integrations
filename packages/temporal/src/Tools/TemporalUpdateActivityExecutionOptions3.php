<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Update activity execution options.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/activities/{activityId}/update-options.
 */
class TemporalUpdateActivityExecutionOptions3 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_update_activity_execution_options_3';
    protected const DESCRIPTION = 'Update activity execution options

Official Temporal endpoint: POST /namespaces/{namespace}/activities/{activityId}/update-options

UpdateActivityExecutionOptions is called by the client to update the options of an activity by its ID.
 This API can be used to target a workflow activity or a standalone activity.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace of the workflow which scheduled this activity',
  'required' => true,
),
  'activity_id' => array (
  'type' => 'string',
  'description' => 'The ID of the activity to target.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/activities/{activityId}/update-options';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'activityId' => 'activity_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
