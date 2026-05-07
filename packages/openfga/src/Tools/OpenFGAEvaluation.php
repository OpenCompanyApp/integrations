<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * [Experimental] The Evaluation API determines whether a subject is authorized to perform an action on a resource. This endpoint implements the AuthZEN Access Evaluation API specification. ## Request Structure The request requires three components: - **subject**: The entity requesting access (e.g., a user or service) - **action**: The operation being performed (maps to a relation in the authorization model) - **resource**: The object being accessed Each component has a `type` and `id` field, and may include optional `properties` for ABAC (Attribute-Based Access Control) conditions. ## Response The response contains a `decision` field (boolean) indicating whether access is permitted, and an optional `context` object with additional information such as the evaluation ID or error details. ## ABAC Support Properties on subject, action, and resource are automatically merged into the evaluation context with prefixes: - Subject properties: `subject_` - Resource properties: `resource_` - Action properties: `action_` These merged properties can be used in conditions defined in your authorization model. ## Examples ### Basic authorization check Check if user Anne can read a document: ```json { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_read"}, "resource": {"type": "document", "id": "roadmap"} } ``` Response when authorized: ```json { "decision": true } ``` ### Using properties for ABAC Check access with subject and resource attributes: ```json { "subject": { "type": "user", "id": "anne", "properties": {"department": "engineering", "clearance_level": 3} }, "action": {"name": "can_read"}, "resource": { "type": "document", "id": "secret-project", "properties": {"classification": "confidential", "required_clearance": 2} } } ``` ### Using request context Provide additional context for time-based or environmental conditions: ```json { "subject": {"type": "user", "id": "bob"}, "action": {"name": "can_access"}, "resource": {"type": "system", "id": "production"}, "context": { "current_time": "2024-01-15T14:30:00Z", "ip_address": "192.168.1.100", "is_vpn_connected": true } } ``` ### Specifying authorization model Pin the evaluation to a specific authorization model version using the `Openfga-Authorization-Model-Id` header: ``` POST /stores/{store_id}/access/v1/evaluation Openfga-Authorization-Model-Id: 01G50QVV17PECNVAHX1GG4Y5NC { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_write"}, "resource": {"type": "document", "id": "budget-2024"} } ```.
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/access/v1/evaluation.
 */
class OpenFGAEvaluation extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_evaluation';
    protected const DESCRIPTION = '[Experimental] The Evaluation API determines whether a subject is authorized to perform an action on a resource. This endpoint implements the AuthZEN Access Evaluation API specification. ## Request Structure The request requires three components: - **subject**: The entity requesting access (e.g., a user or service) - **action**: The operation being performed (maps to a relation in the authorization model) - **resource**: The object being accessed Each component has a `type` and `id` field, and may include optional `properties` for ABAC (Attribute-Based Access Control) conditions. ## Response The response contains a `decision` field (boolean) indicating whether access is permitted, and an optional `context` object with additional information such as the evaluation ID or error details. ## ABAC Support Properties on subject, action, and resource are automatically merged into the evaluation context with prefixes: - Subject properties: `subject_` - Resource properties: `resource_` - Action properties: `action_` These merged properties can be used in conditions defined in your authorization model. ## Examples ### Basic authorization check Check if user Anne can read a document: ```json { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_read"}, "resource": {"type": "document", "id": "roadmap"} } ``` Response when authorized: ```json { "decision": true } ``` ### Using properties for ABAC Check access with subject and resource attributes: ```json { "subject": { "type": "user", "id": "anne", "properties": {"department": "engineering", "clearance_level": 3} }, "action": {"name": "can_read"}, "resource": { "type": "document", "id": "secret-project", "properties": {"classification": "confidential", "required_clearance": 2} } } ``` ### Using request context Provide additional context for time-based or environmental conditions: ```json { "subject": {"type": "user", "id": "bob"}, "action": {"name": "can_access"}, "resource": {"type": "system", "id": "production"}, "context": { "current_time": "2024-01-15T14:30:00Z", "ip_address": "192.168.1.100", "is_vpn_connected": true } } ``` ### Specifying authorization model Pin the evaluation to a specific authorization model version using the `Openfga-Authorization-Model-Id` header: ``` POST /stores/{store_id}/access/v1/evaluation Openfga-Authorization-Model-Id: 01G50QVV17PECNVAHX1GG4Y5NC { "subject": {"type": "user", "id": "anne"}, "action": {"name": "can_write"}, "resource": {"type": "document", "id": "budget-2024"} } ```

Official OpenFGA endpoint: POST /stores/{store_id}/access/v1/evaluation.';
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
    protected const PATH = '/stores/{store_id}/access/v1/evaluation';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
