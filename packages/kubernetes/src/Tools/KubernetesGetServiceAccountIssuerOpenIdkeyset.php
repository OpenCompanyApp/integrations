<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get service account issuer open idkeyset.
 *
 * Maps to the official Kubernetes endpoint get /openid/v1/jwks/.
 */
class KubernetesGetServiceAccountIssuerOpenIdkeyset extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_service_account_issuer_open_idkeyset';
    protected const DESCRIPTION = 'Get service account issuer open idkeyset

Official Kubernetes endpoint: GET /openid/v1/jwks/

get service account issuer OpenID JSON Web Key Set (contains public token verification keys)';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/openid/v1/jwks/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
