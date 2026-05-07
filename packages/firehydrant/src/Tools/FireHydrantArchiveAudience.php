<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive audience.
 *
 * Maps to the official FireHydrant endpoint delete /v1/audiences/{audience_id}.
 */
class FireHydrantArchiveAudience extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_archive_audience';
    protected const DESCRIPTION = 'Archive audience

Official FireHydrant endpoint: DELETE /v1/audiences/{audience_id}

Archive an audience';
    protected const PARAMETERS = array (
  'audience_id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the audience',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/audiences/{audience_id}';
    protected const PATH_PARAMS = array (
  'audience_id' => 'audience_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
