<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Page a user, team, on-call schedule, or escalation policy.
 *
 * Maps to the official FireHydrant endpoint post /v1/page/signals.
 */
class FireHydrantCreateSignalsPage extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_signals_page';
    protected const DESCRIPTION = 'Page a user, team, on-call schedule, or escalation policy

Official FireHydrant endpoint: POST /v1/page/signals

Used for paging an on-call target within FireHydrant\'s signals product. This can be used for paging users, teams, on-call schedules, and escalation policies.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/page/signals';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
