<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Link sessions for your user.
 *
 * Maps to the official Plaid endpoint post /credit/sessions/get.
 */
class PlaidCreditSessionsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_sessions_get';
    protected const DESCRIPTION = 'Retrieve Link sessions for your user

Official Plaid endpoint: POST /credit/sessions/get

This endpoint can be used for your end users after they complete the Link flow. This endpoint returns a list of Link sessions that your user completed, where each session includes the results from the Link flow. These results include details about the Item that was created and some product related metadata (showing, for example, whether the user finished the bank income verification step).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/sessions/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}