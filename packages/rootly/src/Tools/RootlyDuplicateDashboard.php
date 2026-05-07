<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Duplicates a dashboard.
 *
 * Maps to the official Rootly endpoint post /v1/dashboards/{id}/duplicate.
 */
class RootlyDuplicateDashboard extends AbstractRootlyTool
{
    protected const NAME = 'rootly_duplicate_dashboard';
    protected const DESCRIPTION = 'Duplicates a dashboard

Official Rootly endpoint: POST /v1/dashboards/{id}/duplicate

Duplicates a dashboard';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/dashboards/{id}/duplicate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
