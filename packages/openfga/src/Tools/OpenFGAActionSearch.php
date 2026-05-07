<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * [Experimental] The ActionSearch API returns all actions (relations) that a subject can perform on a specific resource. This is useful for answering questions like "What can Anne do with this document?" or building dynamic UIs that show only the actions a user is permitted to perform. ## Examples ### Find all actions a user can perform on a document ```json { "subject": {"type": "user", "id": "anne"}, "resource": {"type": "document", "id": "roadmap"} } ``` Response: ```json { "results": [ {"name": "can_read"}, {"name": "can_write"}, {"name": "can_share"} ], "page": {"count": 3} } ``` ### Search with ABAC context for time-based permissions ```json { "subject": {"type": "user", "id": "bob"}, "resource": {"type": "report", "id": "quarterly-financials"}, "context": { "current_time": "2024-01-15T14:30:00Z", "user_department": "finance" } } ``` ### Paginated action search ```json { "subject": {"type": "user", "id": "admin"}, "resource": {"type": "system", "id": "production"}, "page": {"limit": 50} } ```.
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/access/v1/search/action.
 */
class OpenFGAActionSearch extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_action_search';
    protected const DESCRIPTION = '[Experimental] The ActionSearch API returns all actions (relations) that a subject can perform on a specific resource. This is useful for answering questions like "What can Anne do with this document?" or building dynamic UIs that show only the actions a user is permitted to perform. ## Examples ### Find all actions a user can perform on a document ```json { "subject": {"type": "user", "id": "anne"}, "resource": {"type": "document", "id": "roadmap"} } ``` Response: ```json { "results": [ {"name": "can_read"}, {"name": "can_write"}, {"name": "can_share"} ], "page": {"count": 3} } ``` ### Search with ABAC context for time-based permissions ```json { "subject": {"type": "user", "id": "bob"}, "resource": {"type": "report", "id": "quarterly-financials"}, "context": { "current_time": "2024-01-15T14:30:00Z", "user_department": "finance" } } ``` ### Paginated action search ```json { "subject": {"type": "user", "id": "admin"}, "resource": {"type": "system", "id": "production"}, "page": {"limit": 50} } ```

Official OpenFGA endpoint: POST /stores/{store_id}/access/v1/search/action.';
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
    protected const PATH = '/stores/{store_id}/access/v1/search/action';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
