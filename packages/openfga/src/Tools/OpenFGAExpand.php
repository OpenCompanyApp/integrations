<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The Expand API will return all users and usersets that have certain relationship with an object in a certain store. This is different from the `/stores/{store_id}/read` API in that both users and computed usersets are returned. Body parameters `tuple_key.object` and `tuple_key.relation` are all required. A `contextual_tuples` object may also be included in the body of the request. This object contains one field `tuple_keys`, which is an array of tuple keys. Each of these tuples may have an associated `condition`. The response will return a tree whose leaves are the specific users and usersets. Union, intersection and difference operator are located in the intermediate nodes. ## Example To expand all users that have the `reader` relationship with object `document:2021-budget`, use the Expand API with the following request body ```json { "tuple_key": { "object": "document:2021-budget", "relation": "reader" }, "authorization_model_id": "01G50QVV17PECNVAHX1GG4Y5NC" } ``` OpenFGA's response will be a userset tree of the users and usersets that have read access to the document. ```json { "tree":{ "root":{ "type":"document:2021-budget#reader", "union":{ "nodes":[ { "type":"document:2021-budget#reader", "leaf":{ "users":{ "users":[ "user:bob" ] } } }, { "type":"document:2021-budget#reader", "leaf":{ "computed":{ "userset":"document:2021-budget#writer" } } } ] } } } } ``` The caller can then call expand API for the `writer` relationship for the `document:2021-budget`. ### Expand Request with Contextual Tuples Given the model ```python model schema 1.1 type user type folder relations define owner: [user] type document relations define parent: [folder] define viewer: [user] or writer define writer: [user] or owner from parent ``` and the initial tuples ```json [{ "user": "user:bob", "relation": "owner", "object": "folder:1" }] ``` To expand all `writers` of `document:1` when `document:1` is put in `folder:1`, the first call could be ```json { "tuple_key": { "object": "document:1", "relation": "writer" }, "contextual_tuples": { "tuple_keys": [ { "user": "folder:1", "relation": "parent", "object": "document:1" } ] } } ``` this returns: ```json { "tree": { "root": { "name": "document:1#writer", "union": { "nodes": [ { "name": "document:1#writer", "leaf": { "users": { "users": [] } } }, { "name": "document:1#writer", "leaf": { "tupleToUserset": { "tupleset": "document:1#parent", "computed": [ { "userset": "folder:1#owner" } ] } } } ] } } } } ``` This tells us that the `owner` of `folder:1` may also be a writer. So our next call could be to find the `owners` of `folder:1` ```json { "tuple_key": { "object": "folder:1", "relation": "owner" } } ``` which gives ```json { "tree": { "root": { "name": "folder:1#owner", "leaf": { "users": { "users": [ "user:bob" ] } } } } } ```.
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/expand.
 */
class OpenFGAExpand extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_expand';
    protected const DESCRIPTION = 'The Expand API will return all users and usersets that have certain relationship with an object in a certain store. This is different from the `/stores/{store_id}/read` API in that both users and computed usersets are returned. Body parameters `tuple_key.object` and `tuple_key.relation` are all required. A `contextual_tuples` object may also be included in the body of the request. This object contains one field `tuple_keys`, which is an array of tuple keys. Each of these tuples may have an associated `condition`. The response will return a tree whose leaves are the specific users and usersets. Union, intersection and difference operator are located in the intermediate nodes. ## Example To expand all users that have the `reader` relationship with object `document:2021-budget`, use the Expand API with the following request body ```json { "tuple_key": { "object": "document:2021-budget", "relation": "reader" }, "authorization_model_id": "01G50QVV17PECNVAHX1GG4Y5NC" } ``` OpenFGA\'s response will be a userset tree of the users and usersets that have read access to the document. ```json { "tree":{ "root":{ "type":"document:2021-budget#reader", "union":{ "nodes":[ { "type":"document:2021-budget#reader", "leaf":{ "users":{ "users":[ "user:bob" ] } } }, { "type":"document:2021-budget#reader", "leaf":{ "computed":{ "userset":"document:2021-budget#writer" } } } ] } } } } ``` The caller can then call expand API for the `writer` relationship for the `document:2021-budget`. ### Expand Request with Contextual Tuples Given the model ```python model schema 1.1 type user type folder relations define owner: [user] type document relations define parent: [folder] define viewer: [user] or writer define writer: [user] or owner from parent ``` and the initial tuples ```json [{ "user": "user:bob", "relation": "owner", "object": "folder:1" }] ``` To expand all `writers` of `document:1` when `document:1` is put in `folder:1`, the first call could be ```json { "tuple_key": { "object": "document:1", "relation": "writer" }, "contextual_tuples": { "tuple_keys": [ { "user": "folder:1", "relation": "parent", "object": "document:1" } ] } } ``` this returns: ```json { "tree": { "root": { "name": "document:1#writer", "union": { "nodes": [ { "name": "document:1#writer", "leaf": { "users": { "users": [] } } }, { "name": "document:1#writer", "leaf": { "tupleToUserset": { "tupleset": "document:1#parent", "computed": [ { "userset": "folder:1#owner" } ] } } } ] } } } } ``` This tells us that the `owner` of `folder:1` may also be a writer. So our next call could be to find the `owners` of `folder:1` ```json { "tuple_key": { "object": "folder:1", "relation": "owner" } } ``` which gives ```json { "tree": { "root": { "name": "folder:1#owner", "leaf": { "users": { "users": [ "user:bob" ] } } } } } ```

Official OpenFGA endpoint: POST /stores/{store_id}/expand.';
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
    protected const PATH = '/stores/{store_id}/expand';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
