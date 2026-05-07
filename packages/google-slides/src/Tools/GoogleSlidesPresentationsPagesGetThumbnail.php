<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

/**
 * Presentations Pages Get Thumbnail.
 *
 * Maps to the official Google Slides endpoint GET /v1/presentations/{presentationId}/pages/{pageObjectId}/thumbnail.
 */
class GoogleSlidesPresentationsPagesGetThumbnail extends AbstractGoogleSlidesTool
{
    protected const NAME = 'google_slides_presentations_pages_get_thumbnail';
    protected const DESCRIPTION = 'Presentations Pages Get Thumbnail

Official Google Slides endpoint: GET /v1/presentations/{presentationId}/pages/{pageObjectId}/thumbnail
Generates a thumbnail of the latest version of the specified page in the presentation and returns a URL to the thumbnail image. This request counts as an [expensive read request](https://developers.google.com/workspace/slides/limits) for quota purposes.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Slides method. Known keys: thumbnailProperties.mimeType, thumbnailProperties.thumbnailSize.',
  ),
  'thumbnailProperties.mimeType' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The optional mime type of the thumbnail image. If you don\'t specify the mime type, the mime type defaults to PNG.',
    'enum' =>
    array (
      0 => 'PNG',
    ),
  ),
  'thumbnailProperties.thumbnailSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The optional thumbnail image size. If you don\'t specify the size, the server chooses a default size of the image.',
    'enum' =>
    array (
      0 => 'THUMBNAIL_SIZE_UNSPECIFIED',
      1 => 'LARGE',
      2 => 'MEDIUM',
      3 => 'SMALL',
      4 => 'WIDTH2000_PX',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/presentations/{presentationId}/pages/{pageObjectId}/thumbnail';
    protected const PATH_PARAMS = array (
  0 => 'pageObjectId',
  1 => 'presentationId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'thumbnailProperties.mimeType',
  1 => 'thumbnailProperties.thumbnailSize',
);
    protected const BODY_REQUIRED = false;
}
