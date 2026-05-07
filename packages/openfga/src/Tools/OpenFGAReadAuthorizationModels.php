<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The ReadAuthorizationModels API will return all the authorization models for a certain store. OpenFGA's response will contain an array of all authorization models, sorted in descending order of creation. ## Example Assume that a store's authorization model has been configured twice. To get all the authorization models that have been created in this store, call GET authorization-models. The API will return a response that looks like: ```json { "authorization_models": [ { "id": "01G50QVV17PECNVAHX1GG4Y5NC", "type_definitions": [...] }, { "id": "01G4ZW8F4A07AKQ8RHSVG9RW04", "type_definitions": [...] }, ], "continuation_token": "eyJwayI6IkxBVEVTVF9OU0NPTkZJR19hdXRoMHN0b3JlIiwic2siOiIxem1qbXF3MWZLZExTcUoyN01MdTdqTjh0cWgifQ==" } ``` If there are no more authorization models available, the `continuation_token` field will be empty ```json { "authorization_models": [ { "id": "01G50QVV17PECNVAHX1GG4Y5NC", "type_definitions": [...] }, { "id": "01G4ZW8F4A07AKQ8RHSVG9RW04", "type_definitions": [...] }, ], "continuation_token": "" } ```.
 *
 * Maps to the official OpenFGA endpoint GET /stores/{store_id}/authorization-models.
 */
class OpenFGAReadAuthorizationModels extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_read_authorization_models';
    protected const DESCRIPTION = 'The ReadAuthorizationModels API will return all the authorization models for a certain store. OpenFGA\'s response will contain an array of all authorization models, sorted in descending order of creation. ## Example Assume that a store\'s authorization model has been configured twice. To get all the authorization models that have been created in this store, call GET authorization-models. The API will return a response that looks like: ```json { "authorization_models": [ { "id": "01G50QVV17PECNVAHX1GG4Y5NC", "type_definitions": [...] }, { "id": "01G4ZW8F4A07AKQ8RHSVG9RW04", "type_definitions": [...] }, ], "continuation_token": "eyJwayI6IkxBVEVTVF9OU0NPTkZJR19hdXRoMHN0b3JlIiwic2siOiIxem1qbXF3MWZLZExTcUoyN01MdTdqTjh0cWgifQ==" } ``` If there are no more authorization models available, the `continuation_token` field will be empty ```json { "authorization_models": [ { "id": "01G50QVV17PECNVAHX1GG4Y5NC", "type_definitions": [...] }, { "id": "01G4ZW8F4A07AKQ8RHSVG9RW04", "type_definitions": [...] }, ], "continuation_token": "" } ```

Official OpenFGA endpoint: GET /stores/{store_id}/authorization-models.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
      'page_size' => array (
        'type' => 'integer',
        'description' => 'page_size parameter.',
        'required' => false,
      ),
      'continuation_token' => array (
        'type' => 'string',
        'description' => 'continuation_token parameter.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/stores/{store_id}/authorization-models';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
      'page_size' => 'page_size',
      'continuation_token' => 'continuation_token',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
