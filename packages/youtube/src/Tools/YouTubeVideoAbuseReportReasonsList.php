<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Video Abuse Report Reasons List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/videoAbuseReportReasons.
 */
class YouTubeVideoAbuseReportReasonsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_video_abuse_report_reasons_list';
    protected const DESCRIPTION = 'Video Abuse Report Reasons List

Official YouTube Data API endpoint: GET /youtube/v3/videoAbuseReportReasons
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: part, hl.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies the videoCategory resource parts that the API response will include. Supported values are id and snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'hl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `hl`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/videoAbuseReportReasons';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
  1 => 'hl',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
