<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Schemas Validate Message.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+parent}/schemas:validateMessage.
 */
class GooglePubSubProjectsSchemasValidateMessage extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_schemas_validate_message';
    protected const DESCRIPTION = 'Projects Schemas Validate Message

Official Pub/Sub endpoint: POST /v1/{+parent}/schemas:validateMessage
Validates a message against a schema.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Pub/Sub `ValidateMessageRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/schemas:validateMessage';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
