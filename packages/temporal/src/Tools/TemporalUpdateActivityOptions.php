<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Update activity options.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activities-deprecated/update-options.
 */
class TemporalUpdateActivityOptions extends AbstractTemporalTool
{
    protected const NAME = 'temporal_update_activity_options';
    protected const DESCRIPTION = 'Update activity options

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activities-deprecated/update-options

UpdateActivityOptions is called by the client to update the options of an activity by its ID or type.
 If there are multiple pending activities of the provided type - all of them will be updated.
 This API will be deprecated soon and replaced with a newer UpdateActivityExecutionOptions that is better named and
 structured to work well for standalone activities.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace of the workflow which scheduled this activity',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/activities-deprecated/update-options';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
