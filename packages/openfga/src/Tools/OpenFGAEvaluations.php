<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * [Experimental] The Evaluations API allows batch authorization checks in a single request. It supports request-level defaults for subject, action, resource, and context that can be overridden per evaluation item. ## Evaluation Semantics The `options.evaluations_semantic` field controls how evaluations are processed: - `execute_all` (default): Execute all evaluations and return all results - `deny_on_first_deny`: Stop processing on first deny decision - `permit_on_first_permit`: Stop processing on first permit decision When using `deny_on_first_deny` or `permit_on_first_permit`, the response may include fewer items than the request because processing short-circuits when the condition is met. ## Authorization Model Selection To pin evaluations to a specific authorization model version, send the `Openfga-Authorization-Model-Id` header. If the header is not provided, the latest model is used. ## Examples ### Basic batch evaluation Check if a user can perform multiple actions on a document: ```json { "subject": {"type": "user", "id": "anne"}, "resource": {"type": "document", "id": "roadmap"}, "evaluations": [ {"action": {"name": "can_read"}}, {"action": {"name": "can_write"}}, {"action": {"name": "can_delete"}} ] } ``` ### Using evaluation semantics Stop on first permitted action (useful for finding any valid permission): ```json { "subject": {"type": "user", "id": "anne"}, "resource": {"type": "document", "id": "roadmap"}, "evaluations": [ {"action": {"name": "can_read"}}, {"action": {"name": "can_write"}} ], "options": { "evaluations_semantic": "permit_on_first_permit" } } ``` ### Overriding defaults per evaluation Check permissions across multiple resources: ```json { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_read"}, "evaluations": [ {"resource": {"type": "document", "id": "doc1"}}, {"resource": {"type": "document", "id": "doc2"}}, {"resource": {"type": "folder", "id": "folder1"}} ] } ```.
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/access/v1/evaluations.
 */
class OpenFGAEvaluations extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_evaluations';
    protected const DESCRIPTION = '[Experimental] The Evaluations API allows batch authorization checks in a single request. It supports request-level defaults for subject, action, resource, and context that can be overridden per evaluation item. ## Evaluation Semantics The `options.evaluations_semantic` field controls how evaluations are processed: - `execute_all` (default): Execute all evaluations and return all results - `deny_on_first_deny`: Stop processing on first deny decision - `permit_on_first_permit`: Stop processing on first permit decision When using `deny_on_first_deny` or `permit_on_first_permit`, the response may include fewer items than the request because processing short-circuits when the condition is met. ## Authorization Model Selection To pin evaluations to a specific authorization model version, send the `Openfga-Authorization-Model-Id` header. If the header is not provided, the latest model is used. ## Examples ### Basic batch evaluation Check if a user can perform multiple actions on a document: ```json { "subject": {"type": "user", "id": "anne"}, "resource": {"type": "document", "id": "roadmap"}, "evaluations": [ {"action": {"name": "can_read"}}, {"action": {"name": "can_write"}}, {"action": {"name": "can_delete"}} ] } ``` ### Using evaluation semantics Stop on first permitted action (useful for finding any valid permission): ```json { "subject": {"type": "user", "id": "anne"}, "resource": {"type": "document", "id": "roadmap"}, "evaluations": [ {"action": {"name": "can_read"}}, {"action": {"name": "can_write"}} ], "options": { "evaluations_semantic": "permit_on_first_permit" } } ``` ### Overriding defaults per evaluation Check permissions across multiple resources: ```json { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_read"}, "evaluations": [ {"resource": {"type": "document", "id": "doc1"}}, {"resource": {"type": "document", "id": "doc2"}}, {"resource": {"type": "folder", "id": "folder1"}} ] } ```

Official OpenFGA endpoint: POST /stores/{store_id}/access/v1/evaluations.';
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
    protected const PATH = '/stores/{store_id}/access/v1/evaluations';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
