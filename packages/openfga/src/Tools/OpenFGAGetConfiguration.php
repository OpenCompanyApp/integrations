<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * [Experimental] The GetConfiguration API returns metadata about the Policy Decision Point (PDP) including its name, version, supported endpoints, and capabilities. This endpoint follows the AuthZEN specification for PDP discovery. Following the AuthZEN spec's multi-tenant pattern, OpenFGA provides a per-store discovery endpoint at `/.well-known/authzen-configuration/{store_id}`. This returns absolute endpoint URLs specific to that store. ## Example Response ```json { "policy_decision_point": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV", "access_evaluation_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/evaluation", "access_evaluations_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/evaluations", "search_subject_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/search/subject", "search_resource_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/search/resource", "search_action_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/search/action" } ```.
 *
 * Maps to the official OpenFGA endpoint GET /.well-known/authzen-configuration/{store_id}.
 */
class OpenFGAGetConfiguration extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_get_configuration';
    protected const DESCRIPTION = '[Experimental] The GetConfiguration API returns metadata about the Policy Decision Point (PDP) including its name, version, supported endpoints, and capabilities. This endpoint follows the AuthZEN specification for PDP discovery. Following the AuthZEN spec\'s multi-tenant pattern, OpenFGA provides a per-store discovery endpoint at `/.well-known/authzen-configuration/{store_id}`. This returns absolute endpoint URLs specific to that store. ## Example Response ```json { "policy_decision_point": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV", "access_evaluation_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/evaluation", "access_evaluations_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/evaluations", "search_subject_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/search/subject", "search_resource_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/search/resource", "search_action_endpoint": "https://example.com/stores/01ARZ3NDEKTSV4RRFFQ69G5FAV/access/v1/search/action" } ```

Official OpenFGA endpoint: GET /.well-known/authzen-configuration/{store_id}.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'The store ID for which to retrieve configuration. Following the AuthZEN spec\'s multi-tenant pattern, each store has its own discovery endpoint.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/.well-known/authzen-configuration/{store_id}';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
