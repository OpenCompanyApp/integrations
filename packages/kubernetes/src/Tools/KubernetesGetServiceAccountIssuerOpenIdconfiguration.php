<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get service account issuer open idconfiguration.
 *
 * Maps to the official Kubernetes endpoint get /.well-known/openid-configuration/.
 */
class KubernetesGetServiceAccountIssuerOpenIdconfiguration extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_service_account_issuer_open_idconfiguration';
    protected const DESCRIPTION = 'Get service account issuer open idconfiguration

Official Kubernetes endpoint: GET /.well-known/openid-configuration/

get service account issuer OpenID configuration, also known as the \'OIDC discovery doc\'';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/.well-known/openid-configuration/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
