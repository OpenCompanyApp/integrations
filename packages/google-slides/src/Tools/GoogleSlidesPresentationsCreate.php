<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

/**
 * Presentations Create.
 *
 * Maps to the official Google Slides endpoint POST /v1/presentations.
 */
class GoogleSlidesPresentationsCreate extends AbstractGoogleSlidesTool
{
    protected const NAME = 'google_slides_presentations_create';
    protected const DESCRIPTION = 'Presentations Create

Official Google Slides endpoint: POST /v1/presentations
Creates a blank presentation using the title given in the request. If a `presentationId` is provided, it is used as the ID of the new presentation. Otherwise, a new ID is generated. Other fields in the request, including any provided content, are ignored. Returns the created presentation.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Slides API `Presentation` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/presentations';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
