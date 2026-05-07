<?php

namespace OpenCompany\Integrations\GoogleAdminReports\Tools;

/**
 * Channels Stop.
 *
 * Maps to the official Admin Reports endpoint POST /admin/reports_v1/channels/stop.
 */
class GoogleAdminReportsChannelsStop extends AbstractGoogleAdminReportsTool
{
    protected const NAME = 'google_admin_reports_channels_stop';
    protected const DESCRIPTION = 'Channels Stop

Official Admin Reports endpoint: POST /admin/reports_v1/channels/stop
Stop watching resources through this channel.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Admin Reports `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/reports_v1/channels/stop';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
