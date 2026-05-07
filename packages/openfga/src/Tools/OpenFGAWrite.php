<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The Write API will transactionally update the tuples for a certain store. Tuples and type definitions allow OpenFGA to determine whether a relationship exists between an object and an user. In the body, `writes` adds new tuples and `deletes` removes existing tuples. When deleting a tuple, any `condition` specified with it is ignored. The API is not idempotent by default: if, later on, you try to add the same tuple key (even if the `condition` is different), or if you try to delete a non-existing tuple, it will throw an error. To allow writes when an identical tuple already exists in the database, set `"on_duplicate": "ignore"` on the `writes` object. To allow deletes when a tuple was already removed from the database, set `"on_missing": "ignore"` on the `deletes` object. If a Write request contains both idempotent (ignore) and non-idempotent (error) operations, the most restrictive action (error) will take precedence. If a condition fails for a sub-request with an error flag, the entire transaction will be rolled back. This gives developers explicit control over the atomicity of the requests. The API will not allow you to write tuples such as `document:2021-budget#viewer@document:2021-budget#viewer`, because they are implicit. An `authorization_model_id` may be specified in the body. If it is, it will be used to assert that each written tuple (not deleted) is valid for the model specified. If it is not specified, the latest authorization model ID will be used. ## Example ### Adding relationships To add `user:anne` as a `writer` for `document:2021-budget`, call write API with the following ```json { "writes": { "tuple_keys": [ { "user": "user:anne", "relation": "writer", "object": "document:2021-budget" } ], "on_duplicate": "ignore" }, "authorization_model_id": "01G50QVV17PECNVAHX1GG4Y5NC" } ``` ### Removing relationships To remove `user:bob` as a `reader` for `document:2021-budget`, call write API with the following ```json { "deletes": { "tuple_keys": [ { "user": "user:bob", "relation": "reader", "object": "document:2021-budget" } ], "on_missing": "ignore" } } ```.
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/write.
 */
class OpenFGAWrite extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_write';
    protected const DESCRIPTION = 'The Write API will transactionally update the tuples for a certain store. Tuples and type definitions allow OpenFGA to determine whether a relationship exists between an object and an user. In the body, `writes` adds new tuples and `deletes` removes existing tuples. When deleting a tuple, any `condition` specified with it is ignored. The API is not idempotent by default: if, later on, you try to add the same tuple key (even if the `condition` is different), or if you try to delete a non-existing tuple, it will throw an error. To allow writes when an identical tuple already exists in the database, set `"on_duplicate": "ignore"` on the `writes` object. To allow deletes when a tuple was already removed from the database, set `"on_missing": "ignore"` on the `deletes` object. If a Write request contains both idempotent (ignore) and non-idempotent (error) operations, the most restrictive action (error) will take precedence. If a condition fails for a sub-request with an error flag, the entire transaction will be rolled back. This gives developers explicit control over the atomicity of the requests. The API will not allow you to write tuples such as `document:2021-budget#viewer@document:2021-budget#viewer`, because they are implicit. An `authorization_model_id` may be specified in the body. If it is, it will be used to assert that each written tuple (not deleted) is valid for the model specified. If it is not specified, the latest authorization model ID will be used. ## Example ### Adding relationships To add `user:anne` as a `writer` for `document:2021-budget`, call write API with the following ```json { "writes": { "tuple_keys": [ { "user": "user:anne", "relation": "writer", "object": "document:2021-budget" } ], "on_duplicate": "ignore" }, "authorization_model_id": "01G50QVV17PECNVAHX1GG4Y5NC" } ``` ### Removing relationships To remove `user:bob` as a `reader` for `document:2021-budget`, call write API with the following ```json { "deletes": { "tuple_keys": [ { "user": "user:bob", "relation": "reader", "object": "document:2021-budget" } ], "on_missing": "ignore" } } ```

Official OpenFGA endpoint: POST /stores/{store_id}/write.';
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
    protected const PATH = '/stores/{store_id}/write';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
