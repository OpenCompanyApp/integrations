<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The WriteAuthorizationModel API will add a new authorization model to a store. Each item in the `type_definitions` array is a type definition as specified in the field `type_definition`. The response will return the authorization model's ID in the `id` field. ## Example To add an authorization model with `user` and `document` type definitions, call POST authorization-models API with the body: ```json { "type_definitions":[ { "type":"user" }, { "type":"document", "relations":{ "reader":{ "union":{ "child":[ { "this":{} }, { "computedUserset":{ "object":"", "relation":"writer" } } ] } }, "writer":{ "this":{} } } } ] } ``` OpenFGA's response will include the version id for this authorization model, which will look like ``` {"authorization_model_id": "01G50QVV17PECNVAHX1GG4Y5NC"} ```.
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/authorization-models.
 */
class OpenFGAWriteAuthorizationModel extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_write_authorization_model';
    protected const DESCRIPTION = 'The WriteAuthorizationModel API will add a new authorization model to a store. Each item in the `type_definitions` array is a type definition as specified in the field `type_definition`. The response will return the authorization model\'s ID in the `id` field. ## Example To add an authorization model with `user` and `document` type definitions, call POST authorization-models API with the body: ```json { "type_definitions":[ { "type":"user" }, { "type":"document", "relations":{ "reader":{ "union":{ "child":[ { "this":{} }, { "computedUserset":{ "object":"", "relation":"writer" } } ] } }, "writer":{ "this":{} } } } ] } ``` OpenFGA\'s response will include the version id for this authorization model, which will look like ``` {"authorization_model_id": "01G50QVV17PECNVAHX1GG4Y5NC"} ```

Official OpenFGA endpoint: POST /stores/{store_id}/authorization-models.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the OpenFGA API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/stores/{store_id}/authorization-models';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
