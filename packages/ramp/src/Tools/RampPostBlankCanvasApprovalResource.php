<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Approve or reject a blank canvas workflow step.
 *
 * Maps to the official Ramp endpoint post /developer/v1/blank-canvas-approvals/{approval_trigger_instance_id}.
 */
class RampPostBlankCanvasApprovalResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_blank_canvas_approval_resource';
    protected const DESCRIPTION = 'Approve or reject a blank canvas workflow step

Official Ramp endpoint: POST /developer/v1/blank-canvas-approvals/{approval_trigger_instance_id}';
    protected const PARAMETERS = array (
  'approval_trigger_instance_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `approval_trigger_instance_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/blank-canvas-approvals/{approval_trigger_instance_id}';
    protected const PATH_PARAMS = array (
  'approval_trigger_instance_id' => 'approval_trigger_instance_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
