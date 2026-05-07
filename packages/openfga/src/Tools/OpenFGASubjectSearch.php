<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * [Experimental] The SubjectSearch API returns all subjects that have a specific action (relation) on a given resource. This is useful for answering questions like "Who can read this document?" or "Who can administer this folder?" Results can be filtered by subject type and support pagination for large result sets. ## Examples ### Find all users who can read a document ```json { "resource": {"type": "document", "id": "roadmap"}, "action": {"name": "can_read"}, "subject": {"type": "user"} } ``` Response: ```json { "results": [ {"type": "user", "id": "anne"}, {"type": "user", "id": "bob"}, {"type": "user", "id": "charlie"} ], "page": {"count": 3} } ``` ### Paginated search with limit ```json { "resource": {"type": "folder", "id": "engineering"}, "action": {"name": "can_view"}, "subject": {"type": "user"}, "page": {"limit": 10} } ``` ### Continue from previous page ```json { "resource": {"type": "folder", "id": "engineering"}, "action": {"name": "can_view"}, "subject": {"type": "user"}, "page": {"token": "eyJsYXN0X2lkIjoiMTAwIn0=", "limit": 10} } ```.
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/access/v1/search/subject.
 */
class OpenFGASubjectSearch extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_subject_search';
    protected const DESCRIPTION = '[Experimental] The SubjectSearch API returns all subjects that have a specific action (relation) on a given resource. This is useful for answering questions like "Who can read this document?" or "Who can administer this folder?" Results can be filtered by subject type and support pagination for large result sets. ## Examples ### Find all users who can read a document ```json { "resource": {"type": "document", "id": "roadmap"}, "action": {"name": "can_read"}, "subject": {"type": "user"} } ``` Response: ```json { "results": [ {"type": "user", "id": "anne"}, {"type": "user", "id": "bob"}, {"type": "user", "id": "charlie"} ], "page": {"count": 3} } ``` ### Paginated search with limit ```json { "resource": {"type": "folder", "id": "engineering"}, "action": {"name": "can_view"}, "subject": {"type": "user"}, "page": {"limit": 10} } ``` ### Continue from previous page ```json { "resource": {"type": "folder", "id": "engineering"}, "action": {"name": "can_view"}, "subject": {"type": "user"}, "page": {"token": "eyJsYXN0X2lkIjoiMTAwIn0=", "limit": 10} } ```

Official OpenFGA endpoint: POST /stores/{store_id}/access/v1/search/subject.';
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
    protected const PATH = '/stores/{store_id}/access/v1/search/subject';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
