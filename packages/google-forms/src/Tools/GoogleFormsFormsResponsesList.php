<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Responses List.
 *
 * Maps to the official Google Forms endpoint GET /v1/forms/{formId}/responses.
 */
class GoogleFormsFormsResponsesList extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_responses_list';
    protected const DESCRIPTION = 'Forms Responses List

Official Google Forms endpoint: GET /v1/forms/{formId}/responses
List a form\'s responses.';
    protected const PARAMETERS = array (
  'formId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `formId` from the official Google Forms API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Forms method. Known keys: pageSize, filter, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of responses to return. The service may return fewer than this value. If unspecified or zero, at most 5000 responses are returned.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Which form responses to return. Currently, the only supported filters are: * timestamp > *N* which means to get all form responses submitted after (but not at) timestamp *N*. * timestamp >= *N* which means to get all form responses submitted at and after timestamp *N*. For both supported filters, timestamp must be formatted in RFC3339 UTC "Zulu" format. Examples: "2014-10-02T15:01:23Z" and "2014-10-02T15:01:23.045123456Z".',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A page token returned by a previous list response. If this field is set, the form and the values of the filter must be the same as for the original request.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/forms/{formId}/responses';
    protected const PATH_PARAMS = array (
  0 => 'formId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'filter',
  2 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
