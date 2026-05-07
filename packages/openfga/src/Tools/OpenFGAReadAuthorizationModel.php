<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The ReadAuthorizationModel API returns an authorization model by its identifier. The response will return the authorization model for the particular version. ## Example To retrieve the authorization model with ID `01G5JAVJ41T49E9TT3SKVS7X1J` for the store, call the GET authorization-models by ID API with `01G5JAVJ41T49E9TT3SKVS7X1J` as the `id` path parameter. The API will return: ```json { "authorization_model":{ "id":"01G5JAVJ41T49E9TT3SKVS7X1J", "type_definitions":[ { "type":"user" }, { "type":"document", "relations":{ "reader":{ "union":{ "child":[ { "this":{} }, { "computedUserset":{ "object":"", "relation":"writer" } } ] } }, "writer":{ "this":{} } } } ] } } ``` In the above example, there are 2 types (`user` and `document`). The `document` type has 2 relations (`writer` and `reader`)..
 *
 * Maps to the official OpenFGA endpoint GET /stores/{store_id}/authorization-models/{id}.
 */
class OpenFGAReadAuthorizationModel extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_read_authorization_model';
    protected const DESCRIPTION = 'The ReadAuthorizationModel API returns an authorization model by its identifier. The response will return the authorization model for the particular version. ## Example To retrieve the authorization model with ID `01G5JAVJ41T49E9TT3SKVS7X1J` for the store, call the GET authorization-models by ID API with `01G5JAVJ41T49E9TT3SKVS7X1J` as the `id` path parameter. The API will return: ```json { "authorization_model":{ "id":"01G5JAVJ41T49E9TT3SKVS7X1J", "type_definitions":[ { "type":"user" }, { "type":"document", "relations":{ "reader":{ "union":{ "child":[ { "this":{} }, { "computedUserset":{ "object":"", "relation":"writer" } } ] } }, "writer":{ "this":{} } } } ] } } ``` In the above example, there are 2 types (`user` and `document`). The `document` type has 2 relations (`writer` and `reader`).

Official OpenFGA endpoint: GET /stores/{store_id}/authorization-models/{id}.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/stores/{store_id}/authorization-models/{id}';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
