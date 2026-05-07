<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

/**
 * Presentations Pages Get.
 *
 * Maps to the official Google Slides endpoint GET /v1/presentations/{presentationId}/pages/{pageObjectId}.
 */
class GoogleSlidesPresentationsPagesGet extends AbstractGoogleSlidesTool
{
    protected const NAME = 'google_slides_presentations_pages_get';
    protected const DESCRIPTION = 'Presentations Pages Get

Official Google Slides endpoint: GET /v1/presentations/{presentationId}/pages/{pageObjectId}
Gets the latest version of the specified page in the presentation.';
    protected const PARAMETERS = array (
  'pageObjectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `pageObjectId` from the official Google Slides API method.',
  ),
  'presentationId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `presentationId` from the official Google Slides API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/presentations/{presentationId}/pages/{pageObjectId}';
    protected const PATH_PARAMS = array (
  0 => 'pageObjectId',
  1 => 'presentationId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
