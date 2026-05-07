<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Media Upload.
 *
 * Maps to the official Google Chat endpoint POST /v1/{+parent}/attachments:upload.
 */
class GoogleChatMediaUpload extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_media_upload';
    protected const DESCRIPTION = 'Media Upload

Official Google Chat endpoint: POST /v1/{+parent}/attachments:upload
Uploads an attachment. For an example, see [Upload media as a file attachment](https://developers.google.com/workspace/chat/upload-media-attachments). Requires user [authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with one of the following [authorization scopes](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.messages.create` - `https://www.googleapis.com/auth/chat.messages` - `https://www.googleapis.com/auth/chat.import` (import mode spaces only) You can upload attachments up to 200 MB. Certain file types aren\'t supported. For details, see [File types blocked by Google Chat](https://support.google.com/chat/answer/7651457?&co=GENIE.Platform%3DDesktop#File%20types%20blocked%20in%20Google%20Chat).';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Google Chat API method.',
  ),
  'file_path' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Local file path to upload as a Google Chat attachment.',
  ),
  'mime_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'MIME type for the uploaded file. Defaults to application/octet-stream.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Optional UploadAttachmentRequest metadata, such as filename.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/attachments:upload';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = true;
    protected const MEDIA_UPLOAD_PATH = '/upload/v1/{+parent}/attachments:upload';
}
