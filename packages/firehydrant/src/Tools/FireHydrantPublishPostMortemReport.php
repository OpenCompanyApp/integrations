<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Publish a retrospective report.
 *
 * Maps to the official FireHydrant endpoint post /v1/post_mortems/reports/{report_id}/publish.
 */
class FireHydrantPublishPostMortemReport extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_publish_post_mortem_report';
    protected const DESCRIPTION = 'Publish a retrospective report

Official FireHydrant endpoint: POST /v1/post_mortems/reports/{report_id}/publish

Marks an incident retrospective as published and emails all of the participants in the report the summary';
    protected const PARAMETERS = array (
  'report_id' =>
  array (
    'type' => 'string',
    'description' => 'report_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/post_mortems/reports/{report_id}/publish';
    protected const PATH_PARAMS = array (
  'report_id' => 'report_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
