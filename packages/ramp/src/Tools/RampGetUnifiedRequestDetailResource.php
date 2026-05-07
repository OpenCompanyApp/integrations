<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Get details for a specific UnifiedRequest.
 *
 * Maps to the official Ramp endpoint get /developer/v1/unified-requests/{unified_request_id}.
 */
class RampGetUnifiedRequestDetailResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_unified_request_detail_resource';
    protected const DESCRIPTION = 'Get details for a specific UnifiedRequest

Official Ramp endpoint: GET /developer/v1/unified-requests/{unified_request_id}

NOTE: - Response schema is not finalized and will have breaking changes prior to release - This endpoint _is_ user aware, meaning perm-based filtering is applied to the query';
    protected const PARAMETERS = array (
  'unified_request_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `unified_request_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/unified-requests/{unified_request_id}';
    protected const PATH_PARAMS = array (
  'unified_request_id' => 'unified_request_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
