<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * reconcile JWTWith Id.
 *
 * Maps to POST /api/jwt/reconcile in the official FusionAuth OpenAPI document.
 */
class FusionAuthReconcileJwtwithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_reconcile_jwtwith_id',
  'class' => 'FusionAuthReconcileJwtwithId',
  'method' => 'POST',
  'path' => '/api/jwt/reconcile',
  'operation_id' => 'reconcileJWTWithId',
  'summary' => 'reconcile JWTWith Id',
  'description' => 'Reconcile a User to FusionAuth using JWT issued from another Identity Provider.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
