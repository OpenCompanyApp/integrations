<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Duplicates a dashboard panel.
 *
 * Maps to the official Rootly endpoint post /v1/dashboard_panels/{id}/duplicate.
 */
class RootlyDuplicateDashboardPanel extends AbstractRootlyTool
{
    protected const NAME = 'rootly_duplicate_dashboard_panel';
    protected const DESCRIPTION = 'Duplicates a dashboard panel

Official Rootly endpoint: POST /v1/dashboard_panels/{id}/duplicate

Duplicates a dashboard panel';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/dashboard_panels/{id}/duplicate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
