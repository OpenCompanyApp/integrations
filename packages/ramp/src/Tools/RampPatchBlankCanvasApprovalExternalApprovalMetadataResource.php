<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update metadata for a blank canvas external approval request.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/blank-canvas-approvals/{approval_trigger_instance_id}/metadata.
 */
class RampPatchBlankCanvasApprovalExternalApprovalMetadataResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_blank_canvas_approval_external_approval_metadata_resource';
    protected const DESCRIPTION = 'Update metadata for a blank canvas external approval request

Official Ramp endpoint: PATCH /developer/v1/blank-canvas-approvals/{approval_trigger_instance_id}/metadata';
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
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/blank-canvas-approvals/{approval_trigger_instance_id}/metadata';
    protected const PATH_PARAMS = array (
  'approval_trigger_instance_id' => 'approval_trigger_instance_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
