<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * On Payment Method Created.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/payment-method.
 */
class LangSmithOnPaymentMethodCreated extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_on_payment_method_created';
    protected const DESCRIPTION = 'On Payment Method Created

Official endpoint: POST /api/v1/orgs/current/payment-method
On Payment Method Created.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/payment-method';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
