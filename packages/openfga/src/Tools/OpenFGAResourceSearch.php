<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * [Experimental] The ResourceSearch API returns all resources of a given type that a subject has a specific action (relation) on. This is useful for answering questions like "What documents can Anne read?" or "What folders can Bob administer?" The resource type filter is required. Results support pagination for large result sets. ## Examples ### Find all documents a user can read ```json { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_read"}, "resource": {"type": "document"} } ``` Response: ```json { "results": [ {"type": "document", "id": "roadmap"}, {"type": "document", "id": "budget-2024"}, {"type": "document", "id": "team-roster"} ], "page": {"count": 3} } ``` ### Find folders a user can administer with pagination ```json { "subject": {"type": "user", "id": "bob"}, "action": {"name": "can_admin"}, "resource": {"type": "folder"}, "page": {"limit": 25} } ``` ### Search with ABAC context ```json { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_read"}, "resource": {"type": "document"}, "context": { "current_time": "2024-01-15T10:00:00Z", "ip_address": "192.168.1.100" } } ```.
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/access/v1/search/resource.
 */
class OpenFGAResourceSearch extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_resource_search';
    protected const DESCRIPTION = '[Experimental] The ResourceSearch API returns all resources of a given type that a subject has a specific action (relation) on. This is useful for answering questions like "What documents can Anne read?" or "What folders can Bob administer?" The resource type filter is required. Results support pagination for large result sets. ## Examples ### Find all documents a user can read ```json { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_read"}, "resource": {"type": "document"} } ``` Response: ```json { "results": [ {"type": "document", "id": "roadmap"}, {"type": "document", "id": "budget-2024"}, {"type": "document", "id": "team-roster"} ], "page": {"count": 3} } ``` ### Find folders a user can administer with pagination ```json { "subject": {"type": "user", "id": "bob"}, "action": {"name": "can_admin"}, "resource": {"type": "folder"}, "page": {"limit": 25} } ``` ### Search with ABAC context ```json { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_read"}, "resource": {"type": "document"}, "context": { "current_time": "2024-01-15T10:00:00Z", "ip_address": "192.168.1.100" } } ```

Official OpenFGA endpoint: POST /stores/{store_id}/access/v1/search/resource.';
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
    protected const PATH = '/stores/{store_id}/access/v1/search/resource';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
