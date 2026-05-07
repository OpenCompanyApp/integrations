<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a status page subscription.
 *
 * Maps to the official FireHydrant endpoint post /v1/nunc/subscriptions.
 */
class FireHydrantCreateNuncSubscription extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_nunc_subscription';
    protected const DESCRIPTION = 'Create a status page subscription

Official FireHydrant endpoint: POST /v1/nunc/subscriptions

Subscribe to status page updates';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/nunc/subscriptions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
