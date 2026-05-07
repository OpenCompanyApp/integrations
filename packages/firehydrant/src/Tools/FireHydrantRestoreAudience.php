<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Restore audience.
 *
 * Maps to the official FireHydrant endpoint patch /v1/audiences/{audience_id}/restore.
 */
class FireHydrantRestoreAudience extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_restore_audience';
    protected const DESCRIPTION = 'Restore audience

Official FireHydrant endpoint: PATCH /v1/audiences/{audience_id}/restore

Restore a previously archived audience';
    protected const PARAMETERS = array (
  'audience_id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the audience',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/audiences/{audience_id}/restore';
    protected const PATH_PARAMS = array (
  'audience_id' => 'audience_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
