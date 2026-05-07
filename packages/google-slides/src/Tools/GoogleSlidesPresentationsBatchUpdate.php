<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

/**
 * Presentations Batch Update.
 *
 * Maps to the official Google Slides endpoint POST /v1/presentations/{presentationId}:batchUpdate.
 */
class GoogleSlidesPresentationsBatchUpdate extends AbstractGoogleSlidesTool
{
    protected const NAME = 'google_slides_presentations_batch_update';
    protected const DESCRIPTION = 'Presentations Batch Update

Official Google Slides endpoint: POST /v1/presentations/{presentationId}:batchUpdate
Applies one or more updates to the presentation. Each request is validated before being applied. If any request is not valid, then the entire request will fail and nothing will be applied. Some requests have replies to give you some information about how they are applied. Other requests do not need to return information; these each return an empty reply. The order of replies matches that of the requests. For example, suppose you call batchUpdate with four updates, and only the third one returns information. The response would have two empty replies: the reply to the third request, and another empty reply, in that order. Because other users may be editing the presentation, the presentation might not exactly reflect your changes: your changes may be altered with respect to collaborator changes. If there are no collaborators, the presentation should reflect your changes. In any case, the updates in your request are guaranteed to be applied together atomically.';
    protected const PARAMETERS = array (
  'presentationId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `presentationId` from the official Google Slides API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Slides API `BatchUpdatePresentationRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/presentations/{presentationId}:batchUpdate';
    protected const PATH_PARAMS = array (
  0 => 'presentationId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
