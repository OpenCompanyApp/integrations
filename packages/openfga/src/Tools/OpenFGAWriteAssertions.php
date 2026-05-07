<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The WriteAssertions API will upsert new assertions for an authorization model id, or overwrite the existing ones. An assertion is an object that contains a tuple key, the expectation of whether a call to the Check API of that tuple key will return true or false, and optionally a list of contextual tuples..
 *
 * Maps to the official OpenFGA endpoint PUT /stores/{store_id}/assertions/{authorization_model_id}.
 */
class OpenFGAWriteAssertions extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_write_assertions';
    protected const DESCRIPTION = 'The WriteAssertions API will upsert new assertions for an authorization model id, or overwrite the existing ones. An assertion is an object that contains a tuple key, the expectation of whether a call to the Check API of that tuple key will return true or false, and optionally a list of contextual tuples.

Official OpenFGA endpoint: PUT /stores/{store_id}/assertions/{authorization_model_id}.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
      'authorization_model_id' => array (
        'type' => 'string',
        'description' => 'authorization_model_id parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the OpenFGA API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/stores/{store_id}/assertions/{authorization_model_id}';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
      'authorization_model_id' => 'authorization_model_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
