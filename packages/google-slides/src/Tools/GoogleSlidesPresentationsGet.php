<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

/**
 * Presentations Get.
 *
 * Maps to the official Google Slides endpoint GET /v1/presentations/{+presentationId}.
 */
class GoogleSlidesPresentationsGet extends AbstractGoogleSlidesTool
{
    protected const NAME = 'google_slides_presentations_get';
    protected const DESCRIPTION = 'Presentations Get

Official Google Slides endpoint: GET /v1/presentations/{+presentationId}
Gets the latest version of the specified presentation.';
    protected const PARAMETERS = array (
  'presentationId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `presentationId` from the official Google Slides API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/presentations/{+presentationId}';
    protected const PATH_PARAMS = array (
  0 => 'presentationId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'presentationId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
